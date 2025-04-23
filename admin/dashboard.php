<?php
// [1] Sécurité de l’admin
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_admin_login();

// [2] Statistiques
$totalPosts = $pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn();
$totalComments = $pdo->query("SELECT COUNT(*) FROM comments")->fetchColumn();
$totalReported = $pdo->query("SELECT COUNT(*) FROM comments WHERE reported = 1")->fetchColumn();
$totalAdminReplies = $pdo->query("SELECT COUNT(*) FROM comments WHERE author = '[ADMIN]'")->fetchColumn();
$topTags = $pdo->query("
    SELECT tag, COUNT(*) as count 
    FROM comments 
    WHERE tag IS NOT NULL AND tag != '' 
    GROUP BY tag 
    ORDER BY count DESC 
    LIMIT 5
")->fetchAll();

$pageTitle = "Tableau de bord";
?>

<!DOCTYPE html>
<html lang="fr">
<?php include '../includes/head.php'; ?>
<body>
<?php include '../includes/navbar.php'; ?>
<div id="page-transition"></div>

<!-- Titre encadré -->
<div class="glass-box" style="margin-bottom: 20px;">
    <h2 style="color: white; font-size: 2rem; font-weight: bold;">Tableau de bord admin</h2>
</div>

<!-- Stats -->
<div class="dashboard-box" style="background-color: rgba(0,0,0,0.6); padding: 20px; border-radius: 12px;">
    <p><strong>Total messages :</strong> <?= $totalPosts ?></p>
    <p><strong>Total commentaires :</strong> <?= $totalComments ?></p>
    <p><strong>Commentaires signalés :</strong> <?= $totalReported ?></p>
    <p><strong>Réponses admin :</strong> <?= $totalAdminReplies ?></p>

    <!-- Tags -->
    <h4 style="margin-top: 20px; color: #ff1919;">📌 Tags les plus utilisés :</h4>
    <ul style="list-style-type: none; padding-left: 0;">
        <?php foreach ($topTags as $tag): ?>
            <li style="color: white; background-color: #ff191910; padding: 6px 12px; margin-bottom: 6px; border-radius: 8px;">
                <span style="color:#ffa500; font-weight:bold;">🏷 <?= htmlspecialchars($tag['tag']) ?></span>
                <span style="float: right; color: #aaa;">× <?= $tag['count'] ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
