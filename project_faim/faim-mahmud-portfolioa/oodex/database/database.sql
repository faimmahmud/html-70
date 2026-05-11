CREATE DATABASE IF NOT EXISTS faim_portfolio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE faim_portfolio;

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(140) NOT NULL,
    email VARCHAR(190) NOT NULL,
    phone VARCHAR(60) NULL,
    service VARCHAR(120) NOT NULL,
    budget VARCHAR(80) NOT NULL,
    message TEXT NOT NULL,
    source_page VARCHAR(255) NULL,
    status VARCHAR(40) NOT NULL DEFAULT 'new',
    ip_address VARCHAR(45) NULL,
    user_agent VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX email_index (email),
    INDEX status_index (status),
    INDEX created_at_index (created_at)
);
