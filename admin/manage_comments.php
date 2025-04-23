<?php
// [1] Sécurité de l’admin
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_admin_login();

// Traitement d'une réponse admin
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['reply_to'], $_POST['admin_reply_content'])
) {
    $parentId = (int) $_POST['reply_to'];
    $content = trim($_POST['admin_reply_content']);

    if (!empty($content)) {
        $postId = (int) $_POST['post_id'];

        $insert = $pdo->prepare("INSERT INTO comments (post_id, parent_id, author, content) VALUES (?, ?, ?, ?)");
        $insert->execute([
            $postId,
            $parentId,
            '[ADMIN]',
            $content
        ]);

        $_SESSION['flash_success'] = "Réponse ajoutée avec succès.";
        header("Location: manage_comments.php");
        exit;
    }
}

// Traitement des actions admin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tag_comment_id'], $_POST['new_tag'])) {
    $tagId = (int) $_POST['tag_comment_id'];
    $newTag = trim($_POST['new_tag']);

    $update = $pdo->prepare("UPDATE comments SET tag = ? WHERE id = ?");
    $update->execute([$newTag, $tagId]);

    $_SESSION['flash_success'] = "Tag mis à jour.";
    header('Location: manage_comments.php');
    exit;
}

if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $delId = (int) $_GET['delete'];
    $pdo->prepare("DELETE FROM comments WHERE id = ?")->execute([$delId]);
    header('Location: manage_comments.php');
    exit;
}

if (isset($_GET['treat']) && is_numeric($_GET['treat'])) {
    $treatedId = (int) $_GET['treat'];
    $pdo->prepare("UPDATE comments SET reported = 0 WHERE id = ?")->execute([$treatedId]);
    header('Location: manage_comments.php');
    exit;
}

if (isset($_GET['delete_attachment']) && is_numeric($_GET['delete_attachment'])) {
    $commentId = (int) $_GET['delete_attachment'];
    $stmt = $pdo->prepare("SELECT attachment FROM comments WHERE id = ?");
    $stmt->execute([$commentId]);
    $path = $stmt->fetchColumn();

    if ($path && file_exists($path)) {
        unlink($path);
    }

    $pdo->prepare("UPDATE comments SET attachment = NULL WHERE id = ?")->execute([$commentId]);
    $_SESSION['flash_success'] = "Pièce jointe supprimée.";
    header('Location: manage_comments.php');
    exit;
}

$perPage = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $perPage;

$onlyReported = isset($_GET['only_reported']);
$onlyAttachments = isset($_GET['only_attachments']);

if ($onlyReported) {
    $countStmt = $pdo->prepare("SELECT COUNT(*) FROM comments WHERE reported = 1");
    $countStmt->execute();
    $totalCount = $countStmt->fetchColumn();

    $stmt = $pdo->prepare("
        SELECT comments.*, posts.title AS post_title
        FROM comments
        JOIN posts ON comments.post_id = posts.id
        WHERE reported = 1
        ORDER BY created_at DESC
        LIMIT :limit OFFSET :offset
    ");
} elseif ($onlyAttachments) {
    $countStmt = $pdo->prepare("SELECT COUNT(*) FROM comments WHERE attachment IS NOT NULL AND attachment != ''");
    $countStmt->execute();
    $totalCount = $countStmt->fetchColumn();

    $stmt = $pdo->prepare("
        SELECT comments.*, posts.title AS post_title
        FROM comments
        JOIN posts ON comments.post_id = posts.id
        WHERE attachment IS NOT NULL AND attachment != ''
        ORDER BY created_at DESC
        LIMIT :limit OFFSET :offset
    ");
} else {
    $countStmt = $pdo->query("SELECT COUNT(*) FROM comments");
    $totalCount = $countStmt->fetchColumn();

    $stmt = $pdo->prepare("
        SELECT comments.*, posts.title AS post_title
        FROM comments
        JOIN posts ON comments.post_id = posts.id
        ORDER BY reported DESC, created_at DESC
        LIMIT :limit OFFSET :offset
    ");
}

$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$comments = $stmt->fetchAll();
$totalPages = ceil($totalCount / $perPage);

$pageTitle = "Commentaires";
?>

<!DOCTYPE html>
<html lang="fr">
<?php include '../includes/head.php'; ?>
<body>
<?php include '../includes/navbar.php'; ?>
<div id="page-transition"></div>

<?php if (!empty($_SESSION['flash_success'])): ?>
    <p style="color: green; font-weight: bold;"><?= $_SESSION['flash_success'] ?></p>
    <?php unset($_SESSION['flash_success']); ?>
<?php endif; ?>

<div class="glass-box" style="margin-bottom: 25px; padding: 20px;">
    <h2 style="color: #ff1919; margin-bottom: 15px;">🛠️ Gestion des commentaires</h2>
    <form method="get" style="display: flex; flex-direction: column; gap: 10px; align-items: flex-start;">
        <label style="display: inline-flex; align-items: center; gap: 8px; color: white;">
            <input type="checkbox" name="only_reported" value="1" <?= isset($_GET['only_reported']) ? 'checked' : '' ?> style="width: 16px; height: 16px; accent-color: #ff1919;">
            <span>Afficher seulement les commentaires signalés</span>
        </label>

        <label style="display: inline-flex; align-items: center; gap: 8px; color: white;">
            <input type="checkbox" name="only_attachments" value="1" <?= isset($_GET['only_attachments']) ? 'checked' : '' ?> style="width: 16px; height: 16px; accent-color: #ff1919;">
            <span>Afficher seulement ceux avec pièce jointe 📎</span>
        </label>

        <button type="submit" class="btn-neon" style="margin-top: 10px; padding: 6px 14px;">🎯 Filtrer</button>
    </form>
</div>

<?php if (empty($comments)) : ?>
    <p>Aucun commentaire enregistré.</p>
<?php else : ?>
    <ul>
    <?php foreach ($comments as $comment) : ?>
        <li class="glass-box">
            <strong><?= htmlspecialchars($comment['author']) ?></strong> sur <em><?= htmlspecialchars($comment['post_title']) ?></em><br>
            <?= nl2br(htmlspecialchars($comment['content'])) ?><br>

            <?php if (!empty($comment['attachment'])): ?>
                <p>📎 Pièce jointe : <a href="<?= htmlspecialchars($comment['attachment']) ?>" target="_blank">Voir le fichier</a> 
                <a href="manage_comments.php?delete_attachment=<?= $comment['id'] ?>" class="btn-neon" style="background:#400; color:#ff1919; padding: 4px 10px; font-size: 0.85rem;" onclick="return confirm('Supprimer la pièce jointe ?');">🗑 Supprimer</a></p>
            <?php endif; ?>

            <form method="post" action="manage_comments.php" style="margin-top: 8px;">
                <input type="hidden" name="tag_comment_id" value="<?= $comment['id'] ?>">
                <input type="text" name="new_tag" value="<?= htmlspecialchars($comment['tag'] ?? '') ?>" placeholder="Ajouter un tag">
                <button type="submit" class="btn-neon" style="padding: 4px 10px; font-size: 0.85rem;">🏷️ Sauver le tag</button>
            </form>

            <form method="post" style="margin-top:10px;">
                <input type="hidden" name="reply_to" value="<?= $comment['id'] ?>">
                <input type="hidden" name="post_id" value="<?= $comment['post_id'] ?>">
                <textarea name="admin_reply_content" rows="2" placeholder="Répondre en tant qu’admin..." required style="width:100%; margin-bottom:5px;"></textarea>
                <button type="submit" class="btn-neon" style="padding: 5px 12px; font-size: 0.85rem;">💬 Répondre</button>
            </form>

            <small>Posté le <?= $comment['created_at'] ?></small><br>
            <?php if ($comment['reported']): ?><span style="color:red; font-weight:bold;">[Signalé 🚩]</span><br><?php endif; ?>

            <a href="manage_comments.php?delete=<?= $comment['id'] ?>" class="btn-neon" style="background:#400; color:#ff1919; padding: 4px 10px; font-size: 0.85rem;" onclick="return confirm('Supprimer ce commentaire ?');">🗑 Supprimer</a>
            <a href="edit_comment.php?id=<?= $comment['id'] ?>" class="btn-neon" style="padding: 4px 10px; font-size: 0.85rem;">✏️ Modifier</a>
            <?php if ($comment['reported']): ?>
                <a href="manage_comments.php?treat=<?= $comment['id'] ?>" class="btn-neon" style="padding: 4px 10px; font-size: 0.85rem;">✅ Marquer comme traité</a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
    </ul>

    <div style="text-align:center; margin-top: 30px;">
        <?php if ($page > 1): ?>
            <a href="manage_comments.php?page=<?= $page - 1 ?><?= $onlyReported ? '&only_reported=1' : '' ?>" class="btn-neon" style="padding: 6px 12px; font-size: 0.85rem;">⬅️ Précédent</a>
        <?php endif; ?>

        <span style="margin: 0 15px; color:white;">Page <?= $page ?> / <?= $totalPages ?></span>

        <?php if ($page < $totalPages): ?>
            <a href="manage_comments.php?page=<?= $page + 1 ?><?= $onlyReported ? '&only_reported=1' : '' ?>" class="btn-neon" style="padding: 6px 12px; font-size: 0.85rem;">Suivant ➡️</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
</body>
</html>
