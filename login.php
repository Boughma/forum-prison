<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = trim($_POST['identifier'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($identifier) || empty($password)) {
        $error = "Tous les champs sont requis.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$identifier, $identifier]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
                'created_at' => $user['created_at'],
                'avatar' => $user['avatar'] ?? null
            ];

            if ($user['role'] === 'admin') {
                $_SESSION['admin'] = true;
            }

            $_SESSION['just_logged_in'] = true;
            header('Location: login.php');
            exit;
        } else {
            $error = "Identifiants invalides.";
        }
    }
}

$pageTitle = "Connexion";
?>

<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.php'; ?>
<style>
#login-overlay {
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
@keyframes overlayZoomGlow {
  0% { transform: scale(1); text-shadow: 0 0 5px #ff0000, 0 0 10px #ff0000; }
  50% { transform: scale(1.02); text-shadow: 0 0 10px #ff1a1a, 0 0 20px #ff3300; }
  100% { transform: scale(1); text-shadow: 0 0 5px #ff0000, 0 0 10px #ff0000; }
}
#login-overlay.show {
  opacity: 1;
  pointer-events: auto;
  animation: overlayZoomGlow 2.5s ease-in-out;
}
#login-overlay.fade-out {
  opacity: 0;
  transition: opacity 0.3s ease-in-out;
}

#admin-warning {
  display: none;
  background: #220000;
  color: #ff6666;
  border: 1px solid #ff0000;
  padding: 10px;
  margin-top: 10px;
  font-family: 'Orbitron', sans-serif;
  font-size: 0.9em;
  animation: fadeIn 0.5s;
}
</style>

<body>
<a href="index.php">◄ Page d'accueil</a>
<div id="page-transition"></div>
<div id="app-content">
    <h2><div class="glass-box">CONNEXION</div></h2>

    <?php if ($error): ?>
        <div class="glass-box" style="color: red; padding: 10px; margin: 10px 0; animation: fadeIn 0.5s;">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="post" class="glass-box">
        <input type="text" name="identifier" id="identifier" placeholder="Nom d'utilisateur ou email" required><br><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br><br>
        <button type="submit">Se connecter</button>
        <div id="admin-warning">⚠️ Toute tentative de connexion sur un compte admin de la part d’un détenu engendrera de lourdes sanctions.</div>
    </form>

    <p>Nouveau ici? <a href="register.php">Inscrivez-vous</a></p>
</div> <!-- fin app-content -->

<audio id="login-success-sound" src="assets/sounds/login.mp3" preload="auto"></audio>
<audio id="admin-warning-sound" src="assets/sounds/warning.mp3" preload="auto"></audio>
<div id="login-overlay">🔐 Ne troublez pas l'ordre...</div>

<?php if (!empty($_SESSION['just_logged_in']) && !empty($_SESSION['user']['username'])): ?>
<script>
window.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('login-overlay');
    const audio = document.getElementById('login-success-sound');
    const username = <?= json_encode($_SESSION['user']['username']) ?>;
    const isAdmin = <?= json_encode(isset($_SESSION['admin']) && $_SESSION['admin']) ?>;
    const message = isAdmin
        ? ` Faites régner l'ordre, ${username}...`
        : ` Ne troublez pas l'ordre, ${username}...`;

    let i = 0;
    overlay.textContent = "";

    const typewriter = setInterval(() => {
        if (i < message.length) {
            overlay.textContent += message[i];
            i++;
        } else {
            clearInterval(typewriter);
            overlay.classList.add('fade-out');
            document.getElementById('app-content').style.display = 'none';
            setTimeout(() => {
                window.location.href = isAdmin ? 'admin/manage_posts.php' : 'home.php';
            }, 300);
        }
    }, 60);

    overlay.classList.add('show');
    audio.play();
});
</script>
<?php unset($_SESSION['just_logged_in']); endif; ?>

<script>
const identifierInput = document.getElementById('identifier');
const warningBox = document.getElementById('admin-warning');
const warningSound = document.getElementById('admin-warning-sound');

identifierInput.addEventListener('input', function () {
    if (this.value.trim().toLowerCase() === 'admin') {
        warningBox.style.display = 'block';
        warningSound.play();
    } else {
        warningBox.style.display = 'none';
    }
});
</script>

<?php include 'includes/footer.php'; ?>
</body>
</html>
