<?php
session_start();
$pageTitle = "Discussions";
require_once 'includes/db.php';

// Pagination
$perPage = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $perPage;

$search = $_GET['search'] ?? '';
$searchSql = '';
$params = [];

if (!empty($search)) {
    $searchSql = "WHERE p.title LIKE :search OR p.content LIKE :search";
    $params[':search'] = '%' . $search . '%';
}

// ⚠️ Le champ virtuel `last_activity_at` = plus récente date entre création du post OU dernier commentaire
$sql = "SELECT p.*, 
        GREATEST(
            UNIX_TIMESTAMP(p.created_at), 
            IFNULL(
                (SELECT UNIX_TIMESTAMP(MAX(c.created_at)) FROM comments c WHERE c.post_id = p.id), 
                0
            )
        ) AS last_activity,
        (
            SELECT COUNT(*) FROM comments c WHERE c.post_id = p.id
        ) AS replies,
        (
            SELECT author FROM comments c2 WHERE c2.post_id = p.id ORDER BY c2.created_at DESC LIMIT 1
        ) AS last_author,
        (
            SELECT created_at FROM comments c2 WHERE c2.post_id = p.id ORDER BY c2.created_at DESC LIMIT 1
        ) AS last_date
        FROM posts p
        $searchSql
        ORDER BY last_activity DESC
        LIMIT :limit OFFSET :offset";

$stmt = $pdo->prepare($sql);
$params[':limit'] = $perPage;
$params[':offset'] = $offset;

foreach ($params as $key => $val) {
    $stmt->bindValue($key, $val, is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR);
}
$stmt->execute();
$posts = $stmt->fetchAll();

// Total posts
if (!empty($search)) {
    $countStmt = $pdo->prepare("SELECT COUNT(*) FROM posts WHERE title LIKE :search OR content LIKE :search");
    $countStmt->execute([':search' => '%' . $search . '%']);
    $totalPosts = $countStmt->fetchColumn();
} else {
    $totalPosts = $pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn();
}
$totalPages = ceil($totalPosts / $perPage);
?>

<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/navbar.php'; ?>
<div id="page-transition"></div>

<h2 class="dashboard-box" style="color: white; margin-bottom: 20px;">Discussions disponibles</h2>

<form method="get" style="margin-bottom: 30px;">
    <input type="text" name="search" placeholder=" Rechercher un sujet..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    <button type="submit"  class="btn-neon" style="color:rgb(255, 255, 255);">Rechercher</button>
</form>

<?php if (empty($posts)) : ?>
    <p style="color:white">Aucune discussion pour le moment.</p>
<?php else : ?>
    <table style="width:100%; border-collapse: collapse; color: white;">
        <thead>
            <tr style="background-color: rgba(255, 100, 0, 0.1);">
                <th style="text-align: left; padding: 10px;">📄 Titre / Auteur</th>
                <th style="text-align: center; padding: 10px;">💬 Réponses</th>
                <th style="text-align: center; padding: 10px;">🕓 Dernière activité</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post) : ?>
                <tr class="glass-box" style="border-bottom: 1px solid #ff1919;">
                    <td style="padding: 10px;">
                    <a href="post.php?id=<?= $post['id'] ?>" style="font-weight: bold; color: #ff3c3c; font-size: 1.1em;">
                    <?= htmlspecialchars($post['title']) ?>
                        </a><br>
                        <small style="color:#bbb;">par <?= htmlspecialchars($post['author']) ?> - <?= date('d/m/Y H:i', strtotime($post['created_at'])) ?></small>
                    </td>
                    <td style="text-align: center; font-weight: bold; color: #ff9999;">
                        <?= $post['replies'] ?>
                    </td>
                    <td style="text-align: center; font-size: 0.9em;">
                        <?php if ($post['last_author']) : ?>
                            <?= htmlspecialchars($post['last_author']) ?><br>
                            <span style="color:#999;"><?= date('d/m/Y H:i', strtotime($post['last_date'])) ?></span>
                        <?php else : ?>
                            <span style="color:#555;">Aucune réponse</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="text-align:center; margin-top: 20px;">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>" class="btn-neon">⬅️ Précédent</a>
        <?php endif; ?>

        <span style="margin: 0 10px; color: white;">Page <?= $page ?> / <?= $totalPages ?></span>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>" class="btn-neon">Suivant ➡️</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
</body>
</html>
