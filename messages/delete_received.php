<?php
session_start();
require_once '../includes/functions.php';
require_user_login();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message_id'])) {
    $message_id = (int) $_POST['message_id'];

    // Vérifie que le message appartient au destinataire
    $stmt = $pdo->prepare("DELETE FROM private_messages WHERE id = ? AND receiver_id = ?");
    $stmt->execute([$message_id, $_SESSION['user']['id']]);
}

header('Location: inbox.php');
exit;
