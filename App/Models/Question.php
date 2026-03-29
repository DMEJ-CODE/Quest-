<?php

namespace App\Models;

require_once __DIR__ . '/../../Core/Model.php';

class Question extends \Model
{
    protected static $table = 'questions';

    public static function all()
    {
        $db = static::db();
        $sql = "SELECT questions.*, users.username, users.name as author_name 
                FROM questions 
                LEFT JOIN users ON questions.user_id = users.id 
                ORDER BY created_at DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $db = static::db();
        $sql = "SELECT questions.*, users.username, users.name as author_name 
                FROM questions 
                LEFT JOIN users ON questions.user_id = users.id 
                WHERE questions.id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function incrementViews($id)
    {
        $sql = "UPDATE questions SET views = views + 1 WHERE id = :id";
        $stmt = static::db()->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public static function createWithTags($data, $tagsId){
        $db = static::db();
        try{
            $db->beginTransaction();
            
            $sql = "INSERT INTO questions (user_id, title, description, status) 
                    VALUES (:user_id, :title, :description, :status)";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                'user_id' => $data['user_id'],
                'title' => $data['title'],
                'description' => $data['description'],
                'status' => $data['status'] ?? 'open'
            ]);
            
            $questionId = $db->lastInsertId();

            if(!empty($tagsId)){
                $sql = "INSERT INTO question_tag (question_id, tag_id) VALUES (:question_id, :tag_id)";
                $stmtTag = $db->prepare($sql);
                foreach($tagsId as $tagId){
                    $stmtTag->execute(['question_id' => $questionId, 'tag_id' => $tagId]);
                }
            }
            $db->commit();
            return $questionId;
        } catch (\Exception $e) {
            $db->rollBack();
            return false;
        }
    }

    public static function getTags($questionId) {
        $sql = "SELECT tags.* FROM tags 
                JOIN question_tag ON tags.id = question_tag.tag_id 
                WHERE question_tag.question_id = :qid";
        $stmt = static::db()->prepare($sql);
        $stmt->execute(['qid' => $questionId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
