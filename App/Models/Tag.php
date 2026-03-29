<?php
// App/Models/Tag.php

namespace App\Models;

require_once __DIR__ . '/../../Core/Model.php';

class Tag extends \Model {
    protected static $table = 'tags';

    // Retrieve all tags with the number of associated questions
    public static function allWithCount() {
        $sql = "SELECT tags.*, COUNT(question_tag.question_id) as count 
                FROM tags 
                LEFT JOIN question_tag ON tags.id = question_tag.tag_id 
                GROUP BY tags.id 
                ORDER BY count DESC";
        $stmt = static::db()->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}