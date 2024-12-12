CREATE DATABASE IF NOT EXISTS login_system;

USE login_system;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insert admin user
INSERT INTO users (username, password) VALUES 
('Shahriar', 'admin');
