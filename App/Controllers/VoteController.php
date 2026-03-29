<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\Vote;
use App\Models\Question;
use App\Models\Answer;

class VoteController extends BaseController
{
    /**
     * Handle a vote (Ajax or standard)
     */
    public function cast()
    {
        $this->verifyAuthApi();

        $targetId = $_POST['target_id'] ?? null;
        $targetType = $_POST['target_type'] ?? null; // 'question' or 'answer'
        $voteType   = $_POST['vote_type']   ?? null;  // 1 (up) or -1 (down)
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
        $isAjax = $isAjax || isset($_POST['ajax']);

        if (!$targetId || !$targetType || !in_array($voteType, [1, -1])) {
            if ($isAjax) {
                echo json_encode(['success' => false, 'message' => 'Invalid vote data.']);
                exit;
            }
            $this->redirectBack();
        }

        $userId = $_SESSION['user_id'];
        
        // Cast vote via model
        $success = Vote::castVote($userId, $targetId, $targetType, $voteType);

        if ($success) {
            $newScore = $this->syncVoteCount($targetId, $targetType);
            
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'new_score' => $newScore]);
                exit;
            }

            // Redirect to previous page
            $redirectUrl = $_SERVER['HTTP_REFERER'] ?? '/questions';
            header("Location: $redirectUrl");
            exit;
        } else {
            if ($isAjax) {
                echo json_encode(['success' => false, 'message' => 'Error casting vote.']);
                exit;
            }
            die("Error casting vote.");
        }
    }

    /**
     * Sync the total vote count in questions or answers table
     */
    private function syncVoteCount($id, $type)
    {
        $score = Vote::getScore($id, $type);
        $table = ($type === 'question') ? 'questions' : 'answers';
        
        $db = \Database::connect();
        $db->prepare("UPDATE $table SET votes = :score WHERE id = :id")
           ->execute(['score' => $score, 'id' => $id]);
           
        return $score;
    }

    private function verifyAuthApi()
    {
        if (!isset($_SESSION['user_id'])) {
            $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
            $isAjax = $isAjax || isset($_POST['ajax']);
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Unauthorized']);
                exit;
            }
            $this->verifyAuth();
        }
    }

    private function redirectBack($msg = null)
    {
        $url = $_SERVER['HTTP_REFERER'] ?? '/questions';
        header("Location: $url");
        exit;
    }
}
