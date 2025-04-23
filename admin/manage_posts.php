<?php
session_start();
$pageTitle = "Gestion des messages";
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_admin_login();

// Suppression de post
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $pdo->prepare("DELETE FROM posts WHERE id = ?")->execute([$id]);
    header('Location: manage_posts.php');
    exit;
}

// Récupération des posts
$posts = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<?php include '../includes/head.php'; ?>
<body>
<?php include '../includes/navbar.php'; ?>
<div id="page-transition"></div>

<!-- Bienvenue + Ajout -->
<div class="glass-box" style="margin-bottom: 30px;">
    <h2 style="font-size: 2rem; font-weight: bold; color: white;">
        Bienvenue, <span style="color: #ff1919;">
        <?= htmlspecialchars($_SESSION['user']['username'] ?? 'Admin') ?>
        </span>
    </h2>

    <h3 style="font-size: 1.3rem; color: #ff1919; margin-top: 10px;">
        📝 Messages postés :
    </h3>

    <p style="margin-top: 15px;">
        <a href="new_post.php" class="btn-neon" style="padding: 8px 15px; border-radius: 8px; display: inline-block;">
            📄 Ajouter un nouveau message
        </a>
    </p>
</div>

<!-- Liste des posts -->
<?php if (empty($posts)) : ?>
    <p style="color:white">Aucun message pour l’instant.</p>
<?php else : ?>
    <ul style="list-style: none; padding: 0;">
        <?php foreach ($posts as $post) : ?>
            <li class="glass-box" style="margin-bottom: 20px; padding: 20px;">
                <strong style="color:white; font-size: 1.2rem;">
                    <?= htmlspecialchars($post['title']) ?>
                </strong>
                <p style="color: white; margin: 10px 0;">
                    <?= nl2br(htmlspecialchars($post['content'])) ?>
                </p>
                <small style="color: #aaa;">Posté le <?= $post['created_at'] ?></small><br><br>
                <a href="edit_post.php?id=<?= $post['id'] ?>" class="btn-neon" style="padding: 6px 10px; font-size: 0.9rem;">✏️ Modifier</a>
                <a href="manage_posts.php?delete=<?= $post['id'] ?>" onclick="return confirm('Supprimer ce post ?');" class="btn-neon" style="background:#400; color:#ff1919; padding: 6px 10px; font-size: 0.9rem;">🗑 Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
</body>
</html>