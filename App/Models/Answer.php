<?php
// App/Models/Answer.php

namespace App\Models;

require_once __DIR__ . '/../../Core/Model.php';

class Answer extends \Model {
    protected static $table = 'answers';

    // Retrieve answers for a question (with author)
    public static function getByQuestion($questionId) {
        $sql = "SELECT answers.*, users.name as author_name, users.username 
                FROM answers 
                JOIN users ON answers.user_id = users.id 
                WHERE answers.question_id = :qid 
                ORDER BY is_accepted DESC, created_at DESC";
        $stmt = static::db()->prepare($sql);
        $stmt->execute(['qid' => $questionId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Marquer une réponse comme acceptée (Best Answer)
    public static function acceptAnswer($answerId, $questionId) {
        $db = static::db();

        try {
            $db->beginTransaction();

            // 1. Reset all accepted for this question
            $sqlReset = "UPDATE answers SET is_accepted = FALSE WHERE question_id = :qid";
            $stmtReset = $db->prepare($sqlReset);
            $stmtReset->execute(['qid' => $questionId]);

            // 2. Mettre à jour la réponse (is_accepted = TRUE)
            $sqlUpd = "UPDATE answers SET is_accepted = TRUE WHERE id = :aid";
            $stmtUpd = $db->prepare($sqlUpd);
            $stmtUpd->execute(['aid' => $answerId]);

            $db->commit();
            return true;

        } catch (\Exception $e) {
            $db->rollBack();
            return false;
        }
    }
}