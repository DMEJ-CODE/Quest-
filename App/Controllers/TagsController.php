<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\Tag;

class TagsController extends BaseController
{
    /**
     * Follow a tag
     */
    public function follow($tagId)
    {
        $this->verifyAuth();
        $userId = $_SESSION['user_id'];
        
        $db = \Database::connect();
        
        try {
            $stmt = $db->prepare("INSERT IGNORE INTO user_tag_follows (user_id, tag_id) VALUES (?, ?)");
            $result = $stmt->execute([$userId, $tagId]);
            
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Tag followed successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to follow tag']);
            }
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
        exit;
    }

    /**
     * Unfollow a tag
     */
    public function unfollow($tagId)
    {
        $this->verifyAuth();
        $userId = $_SESSION['user_id'];
        
        $db = \Database::connect();
        
        try {
            $stmt = $db->prepare("DELETE FROM user_tag_follows WHERE user_id = ? AND tag_id = ?");
            $result = $stmt->execute([$userId, $tagId]);
            
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Tag unfollowed successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to unfollow tag']);
            }
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
        exit;
    }

    /**
     * Supprime définitivement un tag
     */
    public function destroy($id)
    {
        $this->verifyAuth();
        
        if ($_SESSION['user_role'] !== 'admin') {
            die("Action non autorisée. Seul un administrateur peut supprimer des tags.");
        }

        $db = \Database::connect();
        
        // Supprimer toutes les liaisons question_tag (si pas configuré en ON DELETE CASCADE)
        $stmtLinked = $db->prepare("DELETE FROM question_tag WHERE tag_id = :id");
        $stmtLinked->execute(['id' => $id]);

        $stmt = $db->prepare("DELETE FROM tags WHERE id = :id");
        if ($stmt->execute(['id' => $id])) {
            $this->setFlash('success', "Le tag a été supprimé.");
        } else {
            $this->setFlash('error', "Impossible de supprimer ce tag.");
        }
        
        header('Location: /dashboard/tags/management');
        exit;
    }
}