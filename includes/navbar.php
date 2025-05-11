<?php
if (!isset($pdo)) {
    require_once 'db.php';
}

$notifCount = 0;
$pendingPostsCount = 0;
$unreadMessages = 0;
$isAdmin = false;

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
    $isAdmin = isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin';

    // Messages non lus
    // Réponses à vos commentaires (notifications)
$stmtReplyNotif = $pdo->prepare("SELECT COUNT(*) FROM notifications WHERE recipient_id = ? AND is_read = 0");
$stmtReplyNotif->execute([$userId]);
$replyNotifCount = (int) $stmtReplyNotif->fetchColumn();

    $stmtUnread = $pdo->prepare("SELECT COUNT(*) FROM private_messages WHERE receiver_id = ? AND is_read = 0");
    $stmtUnread->execute([$userId]);
    $unreadMessages = (int) $stmtUnread->fetchColumn();

    if ($isAdmin) {
        // Commentaires signalés non validés
        $stmtNotif = $pdo->query("SELECT COUNT(*) FROM comments WHERE reported = 1 AND validated_by_admin = 0");
        $notifCount = (int) $stmtNotif->fetchColumn();

        // Sujets à valider
        $stmtPosts = $pdo->query("SELECT COUNT(*) FROM posts WHERE is_approved = 0");
        $pendingPostsCount = (int) $stmtPosts->fetchColumn();
    }
}
?>

<nav class="navbar-box">
    <div class="nav-top">
        <a href="/forum-prison/home.php">🏠 Sommaire</a>
        <?php if ($isAdmin): ?>
            | <a href="/forum-prison/admin/dashboard.php">📊 Dashboard</a>
            | <a href="/forum-prison/admin/logs.php">📜 Logs admin</a>
        <?php endif; ?>

        <?php if (isset($_SESSION['user'])): ?>
            | <a href="/forum-prison/messages/inbox.php">
                📬 Messages
                <?php if ($unreadMessages > 0): ?>
                    <span class="notif-red"><?= $unreadMessages ?></span>
                <?php endif; ?>
            </a>
            | <a href="/forum-prison/notifications.php">
    🔔 Réponses
    <?php if ($replyNotifCount > 0): ?>
        <span class="notif-red"><?= $replyNotifCount ?></span>
    <?php endif; ?>
</a>

            | <a href="/forum-prison/profil.php">👤 Profil</a>
            | <a href="/forum-prison/logout_process.php">🚪 Déconnexion</a>
        <?php else: ?>
            | <a href="/forum-prison/login.php">Connexion</a>
        <?php endif; ?>
    </div>

    <?php if (isset($_SESSION['user'])): ?>
        <div class="nav-bottom">
            <?php if ($isAdmin): ?>
                <a href="/forum-prison/admin/manage_posts.php">📝 Gérer les messages</a>
                <a href="/forum-prison/admin/validate_post.php">
                    ✔️ Sujets à valider
                    <?php if ($pendingPostsCount > 0): ?>
                        <span class="notif-orange"><?= $pendingPostsCount ?></span>
                    <?php endif; ?>
                </a>
                <a href="/forum-prison/admin/manage_comments.php">
                    🚨 Commentaires signalés
                    <?php if ($notifCount > 0): ?>
                        <span class="notif-red"><?= $notifCount ?></span>
                    <?php endif; ?>
                </a>
                <a href="/forum-prison/admin/manage_users.php">👥 Gérer Utilisateurs</a>
            <?php else: ?>
                <a href="/forum-prison/new_post.php">🆕 Proposer un sujet</a>
            <?php endif; ?>

            <span class="username-tag">
                👤 <?= htmlspecialchars($_SESSION['user']['username']) ?>
                <?php if ($isAdmin): ?>
                    <span class="admin-badge">ADMIN</span>
                <?php endif; ?>
            </span>
        </div>
    <?php endif; ?>
</nav>
