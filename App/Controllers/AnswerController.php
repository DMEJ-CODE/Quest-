<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\Answer;

class AnswerController extends BaseController
{
    public function store()
    {
        $this->verifyAuth();

        $question_id = $_POST['question_id'] ?? null;
        $explanation = $_POST['explanation'] ?? '';

        if (!$question_id || empty($explanation)) {
            die("Invalid data provided.");
        }

        $db = \Database::connect();
        $sql = "INSERT INTO answers (question_id, user_id, explanation, votes, is_accepted) 
                VALUES (:qid, :uid, :exp, 0, 0)";
        $stmt = $db->prepare($sql);
        $success = $stmt->execute([
            'qid' => $question_id,
            'uid' => $_SESSION['user_id'],
            'exp' => $explanation
        ]);

        if ($success) {
            // Update answers_count in questions table
            $db->prepare("UPDATE questions SET answers_count = answers_count + 1 WHERE id = :qid")->execute(['qid' => $question_id]);
            
            header("Location: /questions/$question_id");
            exit;
        } else {
            die("Error posting answer.");
        }
    }

    public function accept($id)
    {
        $this->verifyAuth();
        
        $db = \Database::connect();
        
        // Find answer and question
        $stmt = $db->prepare("SELECT * FROM answers WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $answer = $stmt->fetch();
        
        if (!$answer) die("Answer not found.");
        
        $stmtQ = $db->prepare("SELECT * FROM questions WHERE id = :id");
        $stmtQ->execute(['id' => $answer['question_id']]);
        $question = $stmtQ->fetch();
        
        if (!$question || $question['user_id'] != $_SESSION['user_id']) {
            $this->setFlash('error', 'Unauthorized action.');
            $this->redirect("/questions/" . $question['id']);
        }
        
        // Use the model method
        Answer::acceptAnswer($id, $question['id']);
        
        $this->setFlash('success', 'Answer accepted globally.');
        $this->redirect("/questions/" . $question['id']);
    }

    public function edit($id)
    {
        $this->verifyAuth();
        $db = \Database::connect();
        
        $stmt = $db->prepare("SELECT * FROM answers WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $answer = $stmt->fetch();
        
        if (!$answer || $answer['user_id'] != $_SESSION['user_id']) {
            $this->setFlash('error', 'Unauthorized access.');
            $this->redirect('/questions');
        }

        return $this->renderPage("Edit Answer - Quest", $this->view('answers.edit', compact('answer')));
    }

    public function update($id)
    {
        $this->verifyAuth();
        $explanation = $_POST['explanation'] ?? '';

        if (empty($explanation)) {
            $this->setFlash('error', 'Answer cannot be empty.');
            $this->redirect("/answers/$id/edit");
        }

        $db = \Database::connect();
        $stmt = $db->prepare("SELECT * FROM answers WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $answer = $stmt->fetch();

        if (!$answer || $answer['user_id'] != $_SESSION['user_id']) {
            $this->setFlash('error', 'Unauthorized access.');
            $this->redirect('/questions');
        }

        $update = $db->prepare("UPDATE answers SET explanation = :exp, updated_at = NOW() WHERE id = :id");
        $success = $update->execute([
            'exp' => $explanation,
            'id' => $id
        ]);

        if ($success) {
            $this->setFlash('success', 'Answer updated successfully.');
            $this->redirect("/questions/" . $answer['question_id']);
        } else {
            $this->setFlash('error', 'Database error.');
            $this->redirect("/answers/$id/edit");
        }
    }

    public function destroy($id)
    {
        $this->verifyAuth();
        $db = \Database::connect();
        
        $stmt = $db->prepare("SELECT * FROM answers WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $answer = $stmt->fetch();
        
        if (!$answer) {
            $this->setFlash('error', 'Answer not found.');
            $this->redirect('/questions');
        }
        
        // Admin or Owner
        if ($answer['user_id'] != $_SESSION['user_id'] && $_SESSION['user_role'] !== 'admin') {
            $this->setFlash('error', 'Unauthorized access.');
            $this->redirect('/questions');
        }

        // Decrement questions.answers_count
        $db->prepare("UPDATE questions SET answers_count = GREATEST(0, answers_count - 1) WHERE id = :qid")
           ->execute(['qid' => $answer['question_id']]);

        // Delete associated votes 
        $db->prepare("DELETE FROM votes WHERE target_id = :id AND target_type = 'answer'")
           ->execute(['id' => $id]);

        $delete = $db->prepare("DELETE FROM answers WHERE id = :id");
        $delete->execute(['id' => $id]);

        $this->setFlash('success', 'Answer deleted successfully.');
        $this->redirect("/questions/" . $answer['question_id']);
    }
}
