<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';

require_user_login();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user']['id'];
$username = $_SESSION['user']['username'];
$pageTitle = "Mon profil";

// Récupérer les commentaires de l'utilisateur
$stmt = $pdo->prepare("SELECT comments.*, posts.title AS post_title FROM comments JOIN posts ON comments.post_id = posts.id WHERE comments.user_id = ? ORDER BY comments.created_at DESC");
$stmt->execute([$userId]);
$comments = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/navbar.php'; ?>
<div id="page-transition"></div>
<audio id="delete-sound" src="assets/sounds/delete.mp3" preload="auto"></audio>
<div class="glass-box" style="margin-bottom: 30px;">
<h2 style="margin-bottom: 0;">Informations personnelles </h2>
    <p><strong>Pseudo :</strong> <?= htmlspecialchars($username) ?></p>
    <p><strong>Adresse email :</strong> <?= htmlspecialchars($_SESSION['user']['email']) ?></p>

    <?php if ($_SESSION['user']['avatar']): ?>
        <img src="<?= htmlspecialchars($_SESSION['user']['avatar']) ?>" alt="Mon avatar" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-top: 10px;">
    <?php endif; ?>
</div>

<div class="glass-box" style="margin-bottom: 30px;">
    <h3>🖼️ Changer mon avatar</h3>
    <form method="post" action="upload_avatar.php" enctype="multipart/form-data" class="custom-file-upload">
        <label for="file-upload">📂 Choisir un fichier</label>
        <input id="file-upload" type="file" name="avatar" accept="image/png, image/jpeg, image/jpg" required>
        <span id="file-name">Aucun fichier choisi</span>
        <br><br>
        <button type="submit" class="btn-neon">Uploader</button>
    </form>
</div>

<hr>
<div class="glass-box" style="margin-bottom: 30px;">
    <h3>🔑 Changer mon mot de passe</h3>

    <?php if (!empty($_SESSION['flash_success'])): ?>
        <p style="color:green;"><?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?></p>
    <?php elseif (!empty($_SESSION['flash_error'])): ?>
        <p style="color:red;"><?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?></p>
    <?php endif; ?>

    <button onclick="togglePasswordForm()" class="btn-neon" style="margin-bottom: 10px;">Modifier mon mot de passe</button>

    <div id="password-form" style="display: none; margin-top: 10px;">
        <form method="post" action="change_password.php">
            <input type="password" name="current_password" placeholder="Mot de passe actuel" required><br><br>
            <input type="password" name="new_password" placeholder="Nouveau mot de passe" required><br><br>
            <input type="password" name="confirm_password" placeholder="Confirmer le nouveau mot de passe" required><br><br>
            <button type="submit" class="btn-neon">Valider</button>
        </form>
    </div>
</div>

<hr>
<div class="glass-box" style="margin-bottom: 30px;">
    <h3>❌ Supprimer mon compte</h3>
    <button onclick="confirmDelete()" class="btn-neon" style="background:#400; color:#ff1919;">Supprimer définitivement</button>
    <form id="delete-form" method="post" action="delete_account.php" style="display:none;">
        <input type="hidden" name="confirm_delete" value="1">
    </form>
</div>

<div id="delete-overlay">Suppression du compte...</div>

<style>
#delete-overlay {
  position: fixed;
  inset: 0;
  background: black;
  color: #ff4d4d;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: 'Orbitron', sans-serif;
  font-size: 2rem;
  z-index: 9999;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.8s ease-in-out;
}
#delete-overlay.show {
  opacity: 1;
  pointer-events: auto;
  animation: overlayZoomGlow 2.5s ease-in-out;
}
@keyframes overlayZoomGlow {
  0% { transform: scale(1); text-shadow: 0 0 5px #ff0000, 0 0 10px #ff0000; }
  50% { transform: scale(1.02); text-shadow: 0 0 10px #ff1a1a, 0 0 20px #ff3300; }
  100% { transform: scale(1); text-shadow: 0 0 5px #ff0000, 0 0 10px #ff0000; }
}
</style>

<script>
function confirmDelete() {
  if (confirm("Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.")) {
    const overlay = document.getElementById('delete-overlay');
    const sound = document.getElementById('delete-sound');
    overlay.textContent = "";
    const message = "Suppression du compte...";
    let i = 0;

    overlay.classList.add("show");
    sound.play();
    const typer = setInterval(() => {
      if (i < message.length) {
        overlay.textContent += message[i++];
      } else {
        clearInterval(typer);
      }
    }, 70);

    setTimeout(() => {
      document.getElementById('delete-form').submit();
    }, 2000);
  }
}
function togglePasswordForm() {
    const form = document.getElementById('password-form');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
document.getElementById('file-upload').addEventListener('change', function () {
    const fileName = this.files[0] ? this.files[0].name : "Aucun fichier choisi";
    document.getElementById('file-name').textContent = fileName;
});
</script>

<hr>
<h3 style="color: white;">💬 Mes commentaires</h3>

<?php if (empty($comments)) : ?>
    <p>Vous n'avez encore posté aucun commentaire.</p>
<?php else : ?>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <li class="glass-box" style="margin-bottom: 10px;">
                Sur <a href="post.php?id=<?= $comment['post_id'] ?>" style="color: #ff1919; font-weight: bold; text-decoration: underline;">
                    <?= htmlspecialchars($comment['post_title']) ?>
                </a><br>
                <?= nl2br(htmlspecialchars($comment['content'])) ?><br>
                <small>Posté le <?= $comment['created_at'] ?></small>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
</body>
</html>
