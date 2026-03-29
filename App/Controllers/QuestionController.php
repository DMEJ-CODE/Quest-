<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\Question;
use PDO;

class QuestionController extends BaseController
{
    private function questionModel()
    {
        return new Question();
    }

    public function index()
    {
        $db = \Database::connect();
        $userId = $_SESSION['user_id'] ?? null;

        // Requête enrichie type "Feed"
        $sql = "SELECT 
                    q.id, q.title, q.description, q.user_id, q.created_at, q.votes, q.views,
                    u.name as author_name, u.email as author_email,
                    (SELECT COUNT(*) FROM answers WHERE question_id = q.id) as answers_count,
                    (SELECT IFNULL(SUM(vote_type), 0) FROM votes WHERE question_id = q.id AND question_id IS NOT NULL) as vote_count,
                    (SELECT COUNT(*) FROM comments WHERE question_id = q.id) as comments_count,
                    GROUP_CONCAT(DISTINCT t.name) as tags
                FROM questions q
                LEFT JOIN users u ON q.user_id = u.id
                LEFT JOIN question_tag qt ON q.id = qt.question_id
                LEFT JOIN tags t ON qt.tag_id = t.id
                GROUP BY q.id
                ORDER BY q.created_at DESC
                LIMIT 30";
        
        $questions = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        // Stats & Trends pour le sidebar
        $qCount = $db->query("SELECT COUNT(*) FROM questions")->fetchColumn();
        $uCount = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
        $trending = $db->query("SELECT t.name, COUNT(qt.question_id) as count FROM tags t LEFT JOIN question_tag qt ON t.id = qt.tag_id GROUP BY t.id ORDER BY count DESC LIMIT 6")->fetchAll(PDO::FETCH_ASSOC);

        $body = $this->view('questions/index', compact('questions', 'qCount', 'uCount', 'trending'));
        return $this->renderPage('Questions Feed', $body, 'Join the discussion and help others in the community');
    }

    public function create()
    {
        $this->verifyAuth();
        $body = $this->view('questions/create');
        return $this->renderPage('Ask a Question', $body, 'Get help from our brilliant community expertise');
    }

    public function store()
    {
        $this->verifyAuth();

        $data = [
            'user_id' => $_SESSION['user_id'],
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'status' => 'open'
        ];

        if (empty($data['title']) || empty($data['description'])) {
            die("Title and description are required.");
        }

        // Handle tags if any
        $tags = $_POST['tags'] ?? [];
        
        $model = $this->questionModel();
        $id = $model->createWithTags($data, $tags);

        if ($id) {
            header('Location: /questions');
            exit;
        } else {
            die("Error creating question.");
        }
    }

    public function show($id)
    {
        $model = $this->questionModel();
        $question = Question::find($id);

        if (!$question) {
            http_response_code(404);
            $body = $this->view('questions/index', [
                'questions' => [],
                'title' => 'Question Not Found',
                'isFiltered' => true
            ]);
            return $this->renderPage('Missing Question', $body);
        }

        // Increment views
        $model->incrementViews($id);

        // Fetch answers (Assuming Answer model exists or we do it directly)
        $db = \Database::connect();
        $stmt = $db->prepare("SELECT answers.*, users.username, users.name as user_name FROM answers JOIN users ON answers.user_id = users.id WHERE question_id = :qid ORDER BY is_accepted DESC, votes DESC, created_at ASC");
        $stmt->execute(['qid' => $id]);
        $answers = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $tags = $model->getTags($id);

        // Fetch Comments
        $questionComments = \App\Models\Comment::getForTarget($id, 'question');
        
        $answerIds = array_column($answers, 'id');
        $answerComments = [];
        if (!empty($answerIds)) {
            $inQuery = implode(',', array_fill(0, count($answerIds), '?'));
            $cStmt = $db->prepare("SELECT c.*, u.name as user_name FROM comments c JOIN users u ON c.user_id = u.id WHERE c.answer_id IN ($inQuery) ORDER BY c.created_at ASC");
            $cStmt->execute($answerIds);
            $allAC = $cStmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($allAC as $c) {
                $answerComments[$c['answer_id']][] = $c;
            }
        }

        $body = $this->view('questions/show', compact('question', 'answers', 'tags', 'questionComments', 'answerComments'));
        return $this->renderPage($question['title'], $body);
    }

    public function edit($id)
    {
        $this->verifyAuth();
        $question = Question::find($id);

        if (!$question || $question['user_id'] != $_SESSION['user_id']) {
            $body = $this->view('questions/index', [
                'questions' => [],
                'title' => 'Access Denied',
                'isFiltered' => true
            ]);
            return $this->renderPage('Unauthorized', $body);
        }

        $body = $this->view('questions/edit', compact('question'));
        return $this->renderPage('Edit Question', $body);
    }

    public function update($id)
    {
        $this->verifyAuth();
        $question = Question::find($id);

        if (!$question || $question['user_id'] != $_SESSION['user_id']) {
            die("Unauthorized access.");
        }

        $data = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'status' => $_POST['status'] ?? 'open'
        ];

        $model = $this->questionModel();
        if (Question::updateStatic($id, $data)) {
            header("Location: /questions/$id");
            exit;
        } else {
            die("Error updating question.");
        }
    }

    public function destroy($id)
    {
        $this->verifyAuth();
        $question = Question::find($id);

        if (!$question || $question['user_id'] != $_SESSION['user_id']) {
            die("Unauthorized access.");
        }

        $model = $this->questionModel();
        if ($model->deleteStatic($id)) {
            header('Location: /questions');
            exit;
        } else {
            die("Error deleting question.");
        }
    }

    public function byTag($tagName)
    {
        $db = \Database::connect();
        $sql = "SELECT 
                    q.id, q.title, q.description, q.user_id, q.created_at, q.votes,
                    u.name as author_name, u.email as author_email,
                    (SELECT COUNT(*) FROM answers WHERE question_id = q.id) as answers_count,
                    (SELECT IFNULL(SUM(vote_type), 0) FROM votes WHERE question_id = q.id AND question_id IS NOT NULL) as vote_count,
                    (SELECT COUNT(*) FROM comments WHERE question_id = q.id) as comments_count,
                    GROUP_CONCAT(DISTINCT t.name) as tags
                FROM questions q
                LEFT JOIN users u ON q.user_id = u.id
                LEFT JOIN question_tag qt ON q.id = qt.question_id
                LEFT JOIN tags t ON qt.tag_id = t.id
                WHERE q.id IN (SELECT question_id FROM question_tag JOIN tags on question_tag.tag_id = tags.id WHERE tags.name = :tag)
                GROUP BY q.id
                ORDER BY q.created_at DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute(['tag' => $tagName]);
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $body = $this->view('questions/index', [
            'questions' => $questions,
            'title' => '#' . $tagName,
            'isFiltered' => true
        ]);
        return $this->renderPage("Tag: $tagName", $body);
    }

    public function search()
    {
        $query = $_GET['q'] ?? '';
        $db = \Database::connect();
        $sql = "SELECT 
                    q.id, q.title, q.description, q.user_id, q.created_at, q.votes, q.views,
                    u.name as author_name, u.email as author_email,
                    (SELECT COUNT(*) FROM answers WHERE question_id = q.id) as answers_count,
                    (SELECT IFNULL(SUM(vote_type), 0) FROM votes WHERE question_id = q.id AND question_id IS NOT NULL) as vote_count,
                    (SELECT COUNT(*) FROM comments WHERE question_id = q.id) as comments_count,
                    GROUP_CONCAT(DISTINCT t.name) as tags
                FROM questions q
                LEFT JOIN users u ON q.user_id = u.id
                LEFT JOIN question_tag qt ON q.id = qt.question_id
                LEFT JOIN tags t ON qt.tag_id = t.id
                WHERE q.title LIKE :q OR q.description LIKE :q
                GROUP BY q.id
                ORDER BY q.created_at DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute(['q' => "%$query%"]);
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $body = $this->view('questions/index', [
            'questions' => $questions,
            'title' => 'Search: ' . $query,
            'isFiltered' => true
        ]);
        return $this->renderPage("Search results for '$query'", $body, 'Found matching community discussions');
    }

    /**
     * Load more questions via AJAX (Infinite Scroll)
     */
    public function loadMore()
    {
        $db = \Database::connect();
        $userId = $_SESSION['user_id'] ?? null;
        $page = isset($_POST['page']) ? (int)$_POST['page'] : 2;
        $itemsPerPage = 10;
        $offset = ($page - 1) * $itemsPerPage;

        $sql = "SELECT 
                    q.id, q.title, q.description, q.user_id, q.created_at, q.votes, q.views,
                    u.name as author_name, u.email as author_email,
                    (SELECT COUNT(*) FROM answers WHERE question_id = q.id) as answers_count,
                    (SELECT IFNULL(SUM(vote_type), 0) FROM votes WHERE question_id = q.id AND question_id IS NOT NULL) as vote_count,
                    (SELECT COUNT(*) FROM comments WHERE question_id = q.id) as comments_count,
                    GROUP_CONCAT(DISTINCT t.name) as tags
                FROM questions q
                LEFT JOIN users u ON q.user_id = u.id
                LEFT JOIN question_tag qt ON q.id = qt.question_id
                LEFT JOIN tags t ON qt.tag_id = t.id
                GROUP BY q.id
                ORDER BY q.created_at DESC
                LIMIT :limit OFFSET :offset";
        
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':limit', $itemsPerPage, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'questions' => $questions]);
        exit;
    }

    public function trending()
    {
        $db = \Database::connect();
        $tagRaw = $_GET['tag'] ?? $_GET['tags'] ?? null;
        
        $where = "";
        $params = [];
        if($tagRaw) {
            $tags = explode(',', $tagRaw);
            $placeholders = [];
            foreach($tags as $i => $t) {
                $p = ":tag$i";
                $placeholders[] = $p;
                $params[$p] = trim($t);
            }
            $plist = implode(',', $placeholders);
            $where = " WHERE q.id IN (SELECT question_id FROM question_tag JOIN tags on question_tag.tag_id = tags.id WHERE tags.name IN ($plist))";
        }

        $sql = "SELECT 
                    q.id, q.title, q.description, q.user_id, q.created_at, q.votes, q.views,
                    u.name as author_name, u.email as author_email,
                    (SELECT COUNT(*) FROM answers WHERE question_id = q.id) as answers_count,
                    (SELECT IFNULL(SUM(vote_type), 0) FROM votes WHERE question_id = q.id AND question_id IS NOT NULL) as vote_count,
                    (SELECT COUNT(*) FROM comments WHERE question_id = q.id) as comments_count,
                    GROUP_CONCAT(DISTINCT t.name) as tags
                FROM questions q
                LEFT JOIN users u ON q.user_id = u.id
                LEFT JOIN question_tag qt ON q.id = qt.question_id
                LEFT JOIN tags t ON qt.tag_id = t.id
                $where
                GROUP BY q.id
                ORDER BY q.votes DESC LIMIT 20";
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $body = $this->view('questions/index', [
            'questions' => $questions,
            'title' => $tagRaw ? 'Trending: ' . $tagRaw : 'Trending Topics',
            'isFiltered' => true
        ]);
        return $this->renderPage('Trending Topics', $body, 'The most discussed subjects in the community');
    }
}
