<?php
session_start();
$pageTitle = "Modifier un message";
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_admin_login();

$error = '';
$success = '';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: manage_posts.php');
    exit;
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    die("<p style='color:red; text-align:center;'>⛔ Post introuvable.</p>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if (empty($title) || empty($content)) {
        $error = "Tous les champs sont requis.";
    } else {
        $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
        $stmt->execute([$title, $content, $id]);
        $success = "Post mis à jour avec succès.";
        $post['title'] = $title;
        $post['content'] = $content;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php include '../includes/head.php'; ?>
<?php include '../includes/header.php'; ?>

<div id="app">
  <div class="glass-box" style="max-width:700px; margin:80px auto;">
    <h2 class="form-title">✏️ Modifier le message</h2>

    <?php if ($error): ?>
      <p class="error-box"><?= htmlspecialchars($error) ?></p>
    <?php elseif ($success): ?>
      <p class="success-box" style="color:limegreen; text-align:center; font-weight:bold;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="post">
      <label class="form-label" for="title">Titre</label>
      <input class="form-input" type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>

      <label class="form-label" for="content">Contenu</label>
      <textarea class="form-input" id="content" name="content" rows="8" required><?= htmlspecialchars($post['content']) ?></textarea>

      <button type="submit" class="btn-neon">💾 Mettre à jour</button>
    </form>

    <div style="text-align:center; margin-top:20px;">
      <a href="manage_posts.php" class="btn-neon">← Retour à la gestion</a>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
