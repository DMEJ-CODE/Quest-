<?php
namespace App\Models;

class Comment
{
    public static function create($userId, $targetId, $targetType, $content)
    {
        $db = \Database::connect();
        $col = ($targetType === 'question') ? 'question_id' : 'answer_id';
        $stmt = $db->prepare("INSERT INTO comments (user_id, $col, content, created_at) VALUES (:uid, :tid, :content, NOW())");
        return $stmt->execute([
            'uid' => $userId,
            'tid' => $targetId,
            'content' => $content
        ]);
    }

    public static function getForTarget($targetId, $targetType)
    {
        $db = \Database::connect();
        $col = ($targetType === 'question') ? 'question_id' : 'answer_id';
        $stmt = $db->prepare("
            SELECT c.*, u.name as user_name 
            FROM comments c 
            JOIN users u ON c.user_id = u.id 
            WHERE c.$col = :tid 
            ORDER BY c.created_at ASC
        ");
        $stmt->execute(['tid' => $targetId]);
        return $stmt->fetchAll();
    }
}
