<?php
// Core/Database.php

class Database {
    // Unique instance (Singleton)
    private static $instance = null;

    // Prevent direct instantiation (new Database())
    private function __construct() {}

    // Static method to get connection
    public static function connect() {
        if (self::$instance === null) {
            $host = 'localhost';
            $db   = 'votting_sys';
            $user = 'root';
            $pass = '220405..'; // Your password
            
            try {
                $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
                self::$instance = new PDO($dsn, $user, $pass);
                
                // PDO configuration to throw exceptions
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                
            } catch (PDOException $e) {
                die("Database connection error: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}