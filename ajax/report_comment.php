<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user']) || !isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo json_encode(['success' => false]);
    exit;
}

$comment_id = (int) $_POST['id'];

// Vérifie si déjà validé par l'admin
$stmt = $pdo->prepare("SELECT validated_by_admin FROM comments WHERE id = ?");
$stmt->execute([$comment_id]);
$comment = $stmt->fetch();

if ($comment && $comment['validated_by_admin']) {
    echo json_encode(['success' => false, 'already_checked' => true]);
    exit;
}

// Sinon, signale le commentaire
$stmt = $pdo->prepare("UPDATE comments SET reported = 1 WHERE id = ?");
$success = $stmt->execute([$comment_id]);

echo json_encode(['success' => $success]);
exit;
