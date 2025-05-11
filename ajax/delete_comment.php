<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo json_encode(['success' => false, 'error' => 'Accès refusé']);
    exit;
}

$commentId = $_POST['id'] ?? null;

if (!$commentId || !is_numeric($commentId)) {
    echo json_encode(['success' => false, 'error' => 'ID invalide']);
    exit;
}

$stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
$success = $stmt->execute([$commentId]);

echo json_encode(['success' => $success]);
exit;
