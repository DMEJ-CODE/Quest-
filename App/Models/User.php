<?php
// App/Models/User.php

namespace App\Models;

require_once __DIR__ . '/../../Core/Model.php';

class User extends \Model
{
    protected static $table = 'users';

    public static function findByEmail($email)
    {
        $sql = "SELECT * FROM " . static::$table . " WHERE email = :email";
        $stmt = static::db()->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function getQuestions($userId)
    {
        $sql = "SELECT * FROM questions WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = static::db()->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getReputation($userId)
    {
        // Simple mock for reputation if the table exists
        try{
            $sql = "SELECT * FROM reputations WHERE user_id = :user_id";
            $stmt = static::db()->prepare($sql);
            $stmt->execute(['user_id' => $userId]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch(\Exception $e){
            return ['score' => 0];
        }
    }
}
