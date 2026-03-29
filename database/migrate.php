#!/usr/bin/env php
<?php
/**
 * Database Migration Script
 * Run this to create necessary tables for voting system
 * 
 * Usage: php database/migrate.php
 */

require_once __DIR__ . '/../Core/Database.php';

try {
    $db = \Database::connect();
    
    echo "🔄 Creating tables...\n\n";
    
    // Read and execute migration file
    $migrationFile = __DIR__ . '/migrations/create_login_history_table.sql';
    if (!file_exists($migrationFile)) {
        throw new Exception("Migration file not found: $migrationFile");
    }
    
    $sql = file_get_contents($migrationFile);
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    
    foreach ($statements as $statement) {
        if (empty($statement)) continue;
        
        try {
            $db->exec($statement);
            echo "✓ Executed: " . substr($statement, 0, 60) . "...\n";
        } catch (\PDOException $e) {
            // Ignore "table already exists" errors
            if (strpos($e->getMessage(), 'already exists') === false) {
                throw $e;
            }
            echo "⚠ Table already exists: " . substr($statement, 0, 60) . "...\n";
        }
    }
    
    echo "\n✅ Database migration completed successfully!\n";
    echo "Tables created:\n";
    echo "  - login_history (user session tracking)\n";
    echo "  - 2fa_devices (two-factor authentication)\n";
    echo "  - user_settings (user preferences)\n";
    
} catch (\Exception $e) {
    echo "❌ Migration failed:\n";
    echo "   Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
