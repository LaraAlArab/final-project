<?php
require('../connection.php');

$data = json_decode(file_get_contents("php://input"), true);
$post_id = $data['id'] ?? 0;

// Delete related comments first
// Safe from SQL Injection — using prepared statement
$pdo->prepare("DELETE FROM comments WHERE post_id = ?")->execute([$post_id]);

// Then delete the post
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
$success = $stmt->execute([$post_id]);

header('Content-Type: application/json');
echo json_encode(['success' => $success]);
