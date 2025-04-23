<?php
session_start();
$pageTitle = "Ajouter un message";
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_admin_login();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if (empty($title) || empty($content)) {
        $error = "Tous les champs sont requis.";
    } else {
        $author = $_SESSION['user']['username'] ?? 'Anonyme';
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, author) VALUES (?, ?, ?)");
        $stmt->execute([$title, $content, $author]);

        $success = "Message publié avec succès !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php include '../includes/head.php'; ?>
<body>
<?php include '../includes/navbar.php'; ?>
<div id="page-transition"></div>

<div id="app-content">
    <div class="post-container" style="background: rgba(10, 10, 10, 0.85); border-radius: 12px; border: 1px solid #ff5500; box-shadow: 0 0 12px rgba(255, 80, 0, 0.4); padding: 25px; margin-bottom: 30px; color: white; max-width: 700px; margin-inline: auto;">
        <h2 style="color: #ff4c4c; font-size: 1.8em; margin-bottom: 8px;">Ajouter un nouveau message</h2>
        <hr style="border: none; height: 2px; background: linear-gradient(to right, #ff1919, #ff3300); margin-bottom: 15px;">

        <?php if ($error): ?>
            <p style="color:red; font-weight:bold;"><?= htmlspecialchars($error) ?></p>
        <?php elseif ($success): ?>
            <p style="color:limegreen; font-weight:bold;"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>

        <form method="post" style="display: flex; flex-direction: column; gap: 15px;">
            <label for="title" style="color: #ff4d4d;">Titre du message :</label>
            <input type="text" name="title" id="title" class="form-input" placeholder="Titre du message" required>

            <label for="content" style="color: #ff4d4d;">Contenu :</label>
            <textarea name="content" id="content" class="form-input" rows="6" placeholder="Contenu du message" required></textarea>

            <button type="submit" class="btn-neon" style="margin-top: 10px;">Publier</button>
        </form>

        <p style="margin-top: 20px;"><a href="manage_posts.php" style="color: #ff4c4c; text-decoration: underline;">&larr; Retour à la gestion</a></p>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
