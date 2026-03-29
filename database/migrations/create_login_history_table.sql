-- Create login_history table to track user login sessions
CREATE TABLE IF NOT EXISTS login_history (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    browser_name VARCHAR(100),
    device_type VARCHAR(50),
    location VARCHAR(255),
    login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    logout_time TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX(user_id),
    INDEX(login_time)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create 2fa_devices table for two-factor authentication
CREATE TABLE IF NOT EXISTS `2fa_devices` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    device_name VARCHAR(255),
    secret_key VARCHAR(255) NOT NULL,
    backup_codes LONGTEXT,
    is_enabled BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_used TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create user_tag_follows table for tag following system
CREATE TABLE IF NOT EXISTS user_tag_follows (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    tag_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_user_tag (user_id, tag_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE,
    INDEX(user_id),
    INDEX(tag_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample login history for testing
INSERT INTO login_history (user_id, ip_address, browser_name, device_type, location, login_time) VALUES
(1, '192.168.1.100', 'Chrome', 'Desktop', 'Douala, Cameroon', DATE_SUB(NOW(), INTERVAL 2 HOUR)),
(1, '192.168.1.101', 'Firefox', 'Laptop', 'Yaoundé, Cameroon', DATE_SUB(NOW(), INTERVAL 4 HOUR)),
(1, '192.168.1.102', 'Safari', 'Mobile', 'Paris, France', DATE_SUB(NOW(), INTERVAL 24 HOUR));

-- Insert default user settings
INSERT INTO user_settings (user_id, language, dark_mode, notifications_enabled) 
SELECT id, 'en', FALSE, TRUE FROM users WHERE NOT EXISTS (SELECT 1 FROM user_settings WHERE user_id = users.id);
