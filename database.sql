CREATE DATABASE IF NOT EXISTS if0_40201504_uts_mvc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE if0_40201504_uts_mvc;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(15,2) NOT NULL DEFAULT 0.00,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- User sample (password: 12345)
INSERT INTO users (username, email, password) VALUES 
('testing', 'tester@gmail.com', '$2y$10$urQ9zdn4UbHVUNpSLAw0PO9UlSkHc9wJfigvGn.MT1RQoik.REqdO');

-- Items sample
INSERT INTO items (name, description, price, user_id) VALUES 
('Laptop ASUS ROG', 'Laptop gaming dengan spesifikasi tinggi', 15000000, 1),
('Mouse Logitech G502', 'Gaming mouse dengan sensor presisi', 850000, 1),
('Keyboard Mechanical', 'Keyboard mechanical RGB backlight', 1200000, 1);