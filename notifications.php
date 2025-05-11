<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';

require_user_login(); // Redirige si non connecté
$current_user_id = $_SESSION['user']['id']; // Récupère le vrai ID utilisateur connecté

// ✅ GESTION AJAX : suppression individuelle ou totale
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    header('Content-Type: application/json');

    // Supprimer une seule notification
    if (!empty($_POST['delete_id'])) {
        $id = intval($_POST['delete_id']);
        $stmt = $pdo->prepare("DELETE FROM notifications WHERE id = ? AND recipient_id = ?");
        $stmt->execute([$id, $current_user_id]);
        echo json_encode(['success' => true]); exit;
    }

    // Supprimer toutes les notifications
    if (!empty($_POST['delete_all'])) {
        $stmt = $pdo->prepare("DELETE FROM notifications WHERE recipient_id = ?");
        $stmt->execute([$current_user_id]);
        echo json_encode(['success' => true]); exit;
    }

    echo json_encode(['success' => false, 'error' => 'Requête invalide']); exit;
}

// ✅ Récupération des notifications
$stmt = $pdo->prepare("SELECT * FROM notifications WHERE recipient_id = ? ORDER BY created_at DESC");
$stmt->execute([$current_user_id]);
$notifications = $stmt->fetchAll();

require_once 'includes/head.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<div id="page-transition"></div>

<div class="container" style="max-width: 900px; margin: auto; margin-top: 60px;">
    <h2 style="color:white; font-size:2rem;">🔔 Vos notifications</h2>

    <?php if (empty($notifications)): ?>
        <p style="color:white;">Aucune notification pour le moment.</p>
    <?php else: ?>
        <div id="notif-container">
            <?php foreach ($notifications as $notif): ?>
                <div class="notif-card glass-box" id="notif-<?= $notif['id'] ?>" style="margin-bottom: 15px; position: relative;">
                <p style="color:white;">
    <?php
        if ($notif['type'] === 'reply') {
            echo "💬 Nouvelle réponse à <a href='post.php?id=" . $notif['post_id'] . "#comment-" . $notif['comment_id'] . "' style='color:#ffa;'>ce commentaire</a>";
        } elseif ($notif['type'] === 'message') {
            echo "📩 Nouveau message privé reçu";
        } else {
            echo htmlspecialchars($notif['message']);
        }
        if ($notif['is_read'] == 0) {
            echo " <span style='color: orange;'>• Non lue</span>";
        }
    ?>
</p>

                    <button class="delete-notif-btn btn-neon" data-id="<?= $notif['id'] ?>" style="position: absolute; top: 10px; right: 10px;">✖</button>
                </div>
            <?php endforeach; ?>
        </div>
        <button id="delete-all-btn" class="btn-neon" style="margin-top: 20px;">🧹 Nettoyer toutes</button>
    <?php endif; ?>
</div>

<script src="assets/js/notifications.js"></script>

<style>
.toast-message {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: rgba(255, 100, 100, 0.9);
    color: white;
    padding: 12px 18px;
    border-radius: 8px;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 9999;
}
.toast-message.show {
    opacity: 1;
}
</style>
