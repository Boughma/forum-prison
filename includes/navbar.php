<?php
// Si $pdo n’est pas encore initialisé dans certains fichiers :
if (!isset($pdo)) {
    require_once 'db.php';
}

// Compte de commentaires signalés pour pastille admin
$notifCount = 0;
if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
    $stmtNotif = $pdo->query("SELECT COUNT(*) FROM comments WHERE reported = 1");
    $notifCount = (int) $stmtNotif->fetchColumn();
}
?>

<nav>
    <a href="/forum-prison/home.php">Sommaire</a>

    <?php if (!isset($_SESSION['user'])): ?>
        | <a href="/forum-prison/login.php">Connexion</a>

    <?php else: ?>
        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            | <a href="/forum-prison/admin/dashboard.php">Dashboard</a>
            <br>
            | <a href="/forum-prison/admin/manage_posts.php">Gestion des messages</a>
            | <a href="/forum-prison/admin/manage_comments.php">
                Gestion des commentaires
                <?php if ($notifCount > 0): ?>
                    <span style="background:red; color:white; font-weight:bold; padding: 2px 7px; border-radius: 50%; font-size: 0.8em; margin-left: 5px; display:inline-block;">
                        <?= $notifCount ?>
                    </span>
                <?php endif; ?>
            </a>
        <?php endif; ?>

        | <span style="font-weight: bold;">
            <?= htmlspecialchars($_SESSION['user']['username']) ?>
            | <a href="/forum-prison/profil.php">Mon profil</a>

            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                <span style="background:rgb(59, 255, 33); color: black; font-size: 0.7em; padding: 2px 6px; border-radius: 10px; margin-left: 5px;">
                    ADMIN
                </span>
            <?php endif; ?>
        </span>

        | <a href="/forum-prison/logout_process.php">Déconnexion</a>
    <?php endif; ?>
</nav>
