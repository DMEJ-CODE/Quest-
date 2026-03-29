<?php
// Core/Model.php
require_once __DIR__ . '/Database.php';

abstract class Model {
    
    protected static $table;
    
    // Shortcut method to get the database
    protected static function db() {
        return Database::connect();
    }

    // Generic CRUD methods that all models will have
    public static function all() {
        $sql = "SELECT * FROM " . static::$table;
        return static::db()->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $sql = "SELECT * FROM " . static::$table . " WHERE id = :id";
        $stmt = static::db()->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $colums = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO " . static::$table . " ($colums) VALUES ($placeholders)";
        $stmt = static::db()->prepare($sql);
        return $stmt->execute($data);
    }

    public static function updateStatic($id, $data){
        $fields = "";
        foreach($data as $key => $value){
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");
        $sql = "UPDATE " . static::$table . " SET $fields WHERE id = :id";
        $data['id'] = $id;
        $stmt = static::db()->prepare($sql);
        return $stmt->execute($data);
    }

    public static function count(){
        $sql = "SELECT COUNT(*) as total FROM " . static::$table;
        return static::db()->query($sql)->fetch(\PDO::FETCH_ASSOC)['total'] ?? 0;
    }

    public static function deleteStatic($id){
        $sql = "DELETE FROM " . static::$table . " WHERE id = :id";
        $stmt = static::db()->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}