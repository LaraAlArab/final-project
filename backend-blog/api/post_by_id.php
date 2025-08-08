<?php
require('../connection.php');

header('Content-Type: application/json');

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);
$post_id = $data['post_id'] ?? null;

if (!$post_id) {
    echo json_encode(['error' => 'post_id is required']);
    exit;
}

// Fetch post by ID
// Safe from SQL Injection using PDO prepared statements
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    echo json_encode(['error' => 'Post not found']);
    exit;
}

// Fetch latest 15 comments on the post
// Safe from SQL Injection using PDO prepared statements
$comments_stmt = $pdo->prepare("
    SELECT comments.*, users.name AS author
    FROM comments
    JOIN users ON comments.user_id = users.id
    WHERE comments.post_id = ?
    ORDER BY comments.id DESC
    LIMIT 15
");
$comments_stmt->execute([$post_id]);
$post['comments'] = $comments_stmt->fetchAll(PDO::FETCH_ASSOC);

// Return post and comments
echo json_encode($post);
