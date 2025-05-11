<?php
session_start();
require_once '../includes/functions.php';
require_user_login();
require_once '../includes/db.php';
require_once '../includes/head.php';
include('../includes/header.php');
require_once '../includes/navbar.php';

$stmt = $pdo->prepare("SELECT id, username FROM users WHERE id != ?");
$stmt->execute([$_SESSION['user']['id']]);
$users = $stmt->fetchAll();

$prefilledId = isset($_GET['to']) && is_numeric($_GET['to']) ? (int) $_GET['to'] : null;
$usernamePrefilled = null;

if ($prefilledId) {
    $stmtUser = $pdo->prepare("SELECT username FROM users WHERE id = ?");
    $stmtUser->execute([$prefilledId]);
    $row = $stmtUser->fetch();
    if ($row) {
        $usernamePrefilled = $row['username'];
    }
}
?>

<style>
.container {
    max-width: 800px;
    margin: 50px auto;
}
.message-header {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,165,0,0.2);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
    color: white;
    text-align: center;
}
.select-box {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    background: rgba(255,255,255,0.05);
    border: none;
    border-radius: 10px;
    color: white;
    font-size: 16px;
}
.button {
    display: inline-block;
    padding: 12px 20px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,165,0,0.2);
    border-radius: 10px;
    color: white;
    text-decoration: none;
    text-align: center;
}
.button:hover {
    background: rgba(255,165,0,0.2);
}
</style>

<div class="container">
    <div class="message-header">
        <h2>✉️ Choisir un destinataire</h2>
    </div>

    <?php if ($prefilledId && $usernamePrefilled): ?>
        <form method="GET" action="send.php" style="text-align:center;">
            <input type="hidden" name="id" value="<?= $prefilledId ?>">
            <p style="color:white; margin-bottom:20px;">
                Destinataire : <strong><?= htmlspecialchars($usernamePrefilled) ?></strong>
            </p>
            <button type="submit" class="button">✉️ Envoyer un message</button>
        </form>
    <?php elseif (empty($users)): ?>
        <p style="color:white; text-align:center;">Aucun autre utilisateur disponible.</p>
    <?php else: ?>
        <form method="GET" action="send.php" style="text-align:center;">
            <select name="id" class="select-box" required>
                <option value="">-- Sélectionner un destinataire --</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['id'] ?>">
                        <?= htmlspecialchars($user['username']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            <button type="submit" class="button">Continuer ➡️</button>
        </form>
    <?php endif; ?>

    <div style="margin-top:20px; text-align:center;">
        <a href="inbox.php" class="button">🔙 Retour à la boîte de réception</a>
    </div>
</div>
