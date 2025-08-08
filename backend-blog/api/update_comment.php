<?php
require('../connection.php');
$data = json_decode(file_get_contents("php://input"), true);
$comment_id = $data['id'] ?? 0;
$new_content = $data['content'] ?? '';

// Safe from SQL Injection using PDO prepared statements
$stmt = $pdo->prepare("UPDATE comments SET content = ? WHERE id = ?");
$success = $stmt->execute([$new_content, $comment_id]);

header('Content-Type: application/json');
echo json_encode(['success' => $success]);
