CREATE DATABASE IF NOT EXISTS blog_api;
USE blog_api;

-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100)
);

-- Posts table
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    content TEXT,
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Comments table
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT,
    post_id INT,
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Dummy users
INSERT INTO users (name, email) VALUES
('John', 'john@hotmailcom'),
('Doe', 'doe@hotmail.com');

-- Dummy posts
INSERT INTO posts (title, content, user_id) VALUES
('First Post', 'This is the content of the first post', 1),
('Second Post', 'This is the content of the second post', 2);

-- Dummy comments
INSERT INTO comments (content, post_id, user_id) VALUES
('Great post!', 1, 2),
('Thanks for sharing', 1, 2),
('Nice work!', 2, 1);
