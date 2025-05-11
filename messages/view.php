<?php
session_start();
require_once '../includes/functions.php';
require_user_login();
require_once '../includes/db.php';
require_once '../includes/head.php';
require_once '../includes/navbar.php';

$message_id = $_GET['id'] ?? null;

if (!$message_id || !is_numeric($message_id)) {
    die("⛔ ID invalide.");
}

// Récupère le message uniquement s'il appartient à l'utilisateur
$stmt = $pdo->prepare("
    SELECT m.*, u.username AS sender_name 
    FROM private_messages m 
    JOIN users u ON m.sender_id = u.id 
    WHERE m.id = ? AND m.receiver_id = ?
");
$stmt->execute([$message_id, $_SESSION['user']['id']]);
$message = $stmt->fetch();

if (!$message) {
    die("⛔ Ce message n'existe pas ou ne vous appartient pas.");
}

// Marquer comme lu si nécessaire
if (!$message['is_read']) {
    $pdo->prepare("UPDATE private_messages SET is_read = 1 WHERE id = ?")->execute([$message_id]);
}
?>

<div id="page-transition"></div>
<div id="app" class="glass-box" style="max-width: 800px; margin: auto; margin-top: 60px;">
<h2 style="color:white;">
    ✉️ Message de 
    <a href="/forum-prison/profil.php?id=<?= $message['sender_id'] ?>" style="color: #ff5555;">
        <?= htmlspecialchars($message['sender_name']) ?>
    </a>
</h2>

    <div style="color:#ff9999; font-weight:bold;">Sujet : <?= htmlspecialchars($message['subject']) ?></div>
    <div style="margin-top:10px; color:white;"><?= nl2br(htmlspecialchars($message['content'])) ?></div>
    <div style="margin-top:20px; color:grey; font-size:0.9em;">Reçu le : <?= date('d/m/Y H:i', strtotime($message['created_at'])) ?></div>

    <div style="margin-top: 20px;">
        <a href="send.php?reply_to=<?= $message['sender_id'] ?>" class="btn-neon">↩️ Répondre</a>
        <a href="inbox.php" class="btn-neon">⬅️ Retour à la boîte de réception</a>
        <a href="delete.php?id=<?= $message['id'] ?>" class="btn-neon" onclick="return confirm('🗑️ Supprimer ce message ?');">🗑️ Supprimer</a>
        </div>
</div>
