<?php
session_start();
header('Content-Type: application/json');
require_once 'includes/db.php';

$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentId = (int)($_POST['comment_id'] ?? 0);
    $userId = $_SESSION['user']['id'] ?? null;
    $action = $_POST['action'] ?? '';

    if (!$userId || !$commentId || !in_array($action, ['like', 'dislike'])) {
        echo json_encode($response);
        exit;
    }

    // Vérifie si un vote existe déjà
    $check = $pdo->prepare("SELECT * FROM likes WHERE comment_id = ? AND user_id = ?");
    $check->execute([$commentId, $userId]);
    $existing = $check->fetch();

    if ($existing) {
        if ($existing['type'] === $action) {
            // Toggle : même action, on retire le vote
            $pdo->prepare("DELETE FROM likes WHERE id = ?")->execute([$existing['id']]);
            $pdo->prepare("UPDATE comments SET {$action}s = {$action}s - 1 WHERE id = ?")->execute([$commentId]);
        } else {
            // Changement d'avis : update le type
            $pdo->prepare("UPDATE likes SET type = ? WHERE id = ?")->execute([$action, $existing['id']]);
            if ($action === 'like') {
                $pdo->prepare("UPDATE comments SET likes = likes + 1, dislikes = dislikes - 1 WHERE id = ?")->execute([$commentId]);
            } else {
                $pdo->prepare("UPDATE comments SET dislikes = dislikes + 1, likes = likes - 1 WHERE id = ?")->execute([$commentId]);
            }
        }
    } else {
        // Premier vote
        $pdo->prepare("INSERT INTO likes (comment_id, user_id, type) VALUES (?, ?, ?)")->execute([$commentId, $userId, $action]);
        $pdo->prepare("UPDATE comments SET {$action}s = {$action}s + 1 WHERE id = ?")->execute([$commentId]);
    }

    // Score final
    $stmt = $pdo->prepare("SELECT likes, dislikes FROM comments WHERE id = ?");
    $stmt->execute([$commentId]);
    $row = $stmt->fetch();
    $score = ($row['likes'] ?? 0) - ($row['dislikes'] ?? 0);

    $type = null;
    if ($existing) {
        if ($existing['type'] === $action) {
            $type = null; // Vote supprimé
        } else {
            $type = $action; // Vote changé
        }
    } else {
        $type = $action; // Premier vote
    }
    
    $response = ['success' => true, 'score' => $score, 'type' => $type];
    }

echo json_encode($response);
