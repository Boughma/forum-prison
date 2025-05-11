<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user'])) {
    echo json_encode(['success' => false, 'error' => 'Non connecté']);
    exit;
}

$user_id = $_SESSION['user']['id'];
$post_id = (int) ($_POST['post_id'] ?? 0);
$parent_id = !empty($_POST['parent_id']) ? (int) $_POST['parent_id'] : null;
$content = trim($_POST['content'] ?? '');
$tag = $_POST['tag'] ?? null;

if (empty($post_id) || empty($content)) {
    echo json_encode(['success' => false, 'error' => 'Champs vides']);
    exit;
}

// Gestion de la pièce jointe
$attachment = null;
if (!empty($_FILES['attachment']['name'])) {
    $uploadDir = '../uploads/comments/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $filename = time() . '_' . basename($_FILES['attachment']['name']);
    $targetPath = $uploadDir . $filename;
    if (move_uploaded_file($_FILES['attachment']['tmp_name'], $targetPath)) {
        $attachment = $filename;
    }
}

$stmt = $pdo->prepare("INSERT INTO comments (post_id, parent_id, user_id, content, tag, attachment, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
$stmt->execute([$post_id, $parent_id, $user_id, $content, $tag, $attachment]);

echo json_encode(['success' => true]);
