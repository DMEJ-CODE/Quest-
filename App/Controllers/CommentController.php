<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\Comment;

class CommentController extends BaseController
{
    public function store()
    {
        $this->verifyAuth();

        $targetId = $_POST['target_id'] ?? null;
        $targetType = $_POST['target_type'] ?? null; // 'question' or 'answer'
        $content = trim($_POST['content'] ?? '');

        if (!$targetId || !$targetType || empty($content)) {
            $this->setFlash('error', 'Comment cannot be empty.');
            $this->redirectBack();
        }

        $userId = $_SESSION['user_id'];
        $success = Comment::create($userId, $targetId, $targetType, $content);

        if ($success) {
            $this->setFlash('success', 'Comment added.');
        } else {
            $this->setFlash('error', 'Failed to add comment.');
        }

        $this->redirectBack();
    }

    public function destroy($id)
    {
        $this->verifyAuth();
        
        $db = \Database::connect();
        
        $stmt = $db->prepare("SELECT * FROM comments WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $comment = $stmt->fetch();
        
        if (!$comment) {
            $this->setFlash('error', 'Comment not found.');
            $this->redirectBack();
        }
        
        if ($comment['user_id'] != $_SESSION['user_id'] && $_SESSION['user_role'] !== 'admin') {
            $this->setFlash('error', 'Unauthorized.');
            $this->redirectBack();
        }

        $delete = $db->prepare("DELETE FROM comments WHERE id = :id");
        $delete->execute(['id' => $id]);

        $this->setFlash('success', 'Comment deleted.');
        $this->redirectBack();
    }

    private function redirectBack()
    {
        $url = $_SERVER['HTTP_REFERER'] ?? '/questions';
        header("Location: $url");
        exit;
    }
}
