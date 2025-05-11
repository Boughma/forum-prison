<?php
session_start();
header('Content-Type: application/json');
require_once '../includes/db.php';

if (!isset($_SESSION['user']['id'])) {
    echo json_encode(['success' => false, 'error' => 'Non autorisé']);
    exit;
}

$user_id = $_SESSION['user']['id'];
$comment_id = (int)($_POST['comment_id'] ?? 0);
$type = $_POST['type'] ?? '';

if (!in_array($type, ['like', 'dislike'])) {
    echo json_encode(['success' => false, 'error' => 'Type invalide']);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM likes WHERE comment_id = ? AND user_id = ?");
$stmt->execute([$comment_id, $user_id]);
$existing = $stmt->fetch();

if ($existing) {
    if ($existing['type'] === $type) {
        $pdo->prepare("DELETE FROM likes WHERE id = ?")->execute([$existing['id']]);
    } else {
        $pdo->prepare("UPDATE likes SET type = ?, created_at = NOW() WHERE id = ?")->execute([$type, $existing['id']]);
    }
} else {
    $pdo->prepare("INSERT INTO likes (comment_id, user_id, type) VALUES (?, ?, ?)")->execute([$comment_id, $user_id, $type]);
}

$vote_stmt = $pdo->prepare("SELECT 
    SUM(CASE WHEN type = 'like' THEN 1 WHEN type = 'dislike' THEN -1 ELSE 0 END) as score 
    FROM likes WHERE comment_id = ?");
$vote_stmt->execute([$comment_id]);
$score = $vote_stmt->fetchColumn();

echo json_encode(['success' => true, 'score' => (int)$score]);
exit;
