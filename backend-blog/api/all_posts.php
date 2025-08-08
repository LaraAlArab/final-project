<?php
require('../connection.php');

// No user input — this query is safe from SQL Injection
$stmt = $pdo->query("
  SELECT posts.*, users.name AS author,
    (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comment_count
  FROM posts
  JOIN users ON posts.user_id = users.id
  ORDER BY posts.id DESC
");

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($posts);
?>
