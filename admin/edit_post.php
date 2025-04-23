<?php
session_start();
$pageTitle = "Modifier un message";
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_admin_login(); // ✅ vérifie que l'admin est connecté

$error = '';
$success = '';

// Vérifier si un ID de post est fourni
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: manage_posts.php');
    exit;
}

$id = (int) $_GET['id'];

// Récupérer le post à modifier
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    die("Post introuvable.");
}

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if (empty($title) || empty($content)) {
        $error = "Tous les champs sont requis.";
    } else {
        $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
        $stmt->execute([$title, $content, $id]);
        $success = "Post mis à jour avec succès.";
        // Recharger les données mises à jour
        $post['title'] = $title;
        $post['content'] = $content;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php include '../includes/head.php'; ?>
<body>
<?php include '../includes/navbar.php'; ?>
<div id="page-transition"></div>


    <h2>Modifier le message</h2>

    <?php if ($error): ?>
        <p style="color:red"><?= htmlspecialchars($error) ?></p>
    <?php elseif ($success): ?>
        <p style="color:green"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br><br>
        <textarea name="content" rows="5" cols="40" required><?= htmlspecialchars($post['content']) ?></textarea><br><br>
        <button type="submit">Mettre à jour</button>
    </form>

    <p><a href="manage_posts.php">← Retour à la gestion</a></p>
    <?php include '../includes/footer.php'; ?>

</body>
</html>
