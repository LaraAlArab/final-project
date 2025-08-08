<?php
require('../connection.php');

$data = json_decode(file_get_contents("php://input"), true);
$user_id = $data['user_id'] ?? 0;

// Safe from SQL Injection using PDO prepared statements
$stmt = $pdo->prepare("
    SELECT * FROM posts
    WHERE user_id = ?
    ORDER BY id DESC
    LIMIT 10
");
$stmt->execute([$user_id]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($posts);
