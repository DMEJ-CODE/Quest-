<?php
// App/Models/Vote.php

namespace App\Models;

require_once __DIR__ . '/../../Core/Model.php';

class Vote extends \Model {
    protected static $table = 'votes';

    /**
     * Voter pour une question OU une réponse
     */
    public static function castVote($userId, $targetId, $targetType, $voteType) {
        $db = static::db();

        $targetColumn = ($targetType === 'question') ? 'question_id' : 'answer_id';
        
        // Simple check
        $sqlCheck = "SELECT * FROM votes WHERE user_id = :uid AND $targetColumn = :tid LIMIT 1";
        $stmtCheck = $db->prepare($sqlCheck);
        $stmtCheck->execute(['uid' => $userId, 'tid' => $targetId]);
        $existingVote = $stmtCheck->fetch(\PDO::FETCH_ASSOC);

        if ($existingVote) {
            if ($existingVote['vote_type'] == $voteType) {
                return static::deleteStatic($existingVote['id']);
            } else {
                return static::updateStatic($existingVote['id'], ['vote_type' => $voteType]);
            }
        } else {
            $sql = "INSERT INTO votes (user_id, $targetColumn, vote_type) VALUES (:uid, :tid, :vt)";
            $stmt = $db->prepare($sql);
            return $stmt->execute(['uid' => $userId, 'tid' => $targetId, 'vt' => $voteType]);
        }
    }

    public static function getScore($targetId, $targetType) {
        $col = ($targetType === 'question') ? 'question_id' : 'answer_id';
        $sql = "SELECT SUM(vote_type) as score FROM votes WHERE $col = :id";
        $stmt = static::db()->prepare($sql);
        $stmt->execute(['id' => $targetId]);
        $res = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $res['score'] ?? 0;
    }
}