CREATE DATABASE IF NOT EXISTS demo_db;
USE demo_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS importantdata (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_name VARCHAR(50),
    data_value VARCHAR(100)
);

INSERT IGNORE INTO users (username, password) VALUES ('admin', 'admin');
INSERT INTO importantdata (data_name, data_value) VALUES 
('Secret 1', 'Confidential Info 1'),
('Secret 2', 'Confidential Info 2'),
('Secret 3', 'Confidential Info 3');



