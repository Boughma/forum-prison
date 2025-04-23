<?php
session_start();
require_once 'includes/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if (empty($username) || empty($email) || empty($password)) {
        $error = "Tous les champs sont requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Adresse email invalide.";
    } elseif ($password !== $confirm) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$email, $username]);
        if ($stmt->fetch()) {
            $error = "Email ou pseudo déjà utilisé.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare("INSERT INTO users (username, email, password, role, created_at) VALUES (?, ?, ?, 'user', NOW())");
            $insert->execute([$username, $email, $hashed]);

            $userId = $pdo->lastInsertId();
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $user = $stmt->fetch();

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['created_at'] = $user['created_at'];
                $_SESSION['just_registered'] = true;

                // pour compatibilité avec navbar
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'created_at' => $user['created_at'],
                    'avatar' => $user['avatar'] ?? null
                ];

                header("Location: register.php");
                exit;
            }
        }
    }
}
?>

<a href="index.php">◄ Page d'accueil</a>

<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.php'; ?>
<style>
#register-overlay {
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
  0% {
    transform: scale(1);
    text-shadow: 0 0 5px #ff0000, 0 0 10px #ff0000;
  }
  50% {
    transform: scale(1.02);
    text-shadow: 0 0 10px #ff1a1a, 0 0 20px #ff3300;
  }
  100% {
    transform: scale(1);
    text-shadow: 0 0 5px #ff0000, 0 0 10px #ff0000;
  }
}
#register-overlay.show {
  opacity: 1;
  pointer-events: auto;
  animation: overlayZoomGlow 2.5s ease-in-out;
}
#register-overlay.fade-out {
  opacity: 0;
  transition: opacity 0.1s ease-in-out;
}
.glow-red {
  box-shadow: 0 0 10px 2px #ff0000, 0 0 20px 4px #ff3300;
  transition: box-shadow 0.3s ease;
}
</style>
<body>
<div id="page-transition"></div>
<div id="app-content">

<h2><div class="glass-box">INSCRIPTION</div></h2>

<?php if ($error): ?>
    <div class="glass-box" style="color: #ff4d4d; padding: 10px; margin: 10px 0; animation: fadeIn 0.5s;">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<form method="post" class="glass-box">
    <input type="text" name="username" placeholder="Pseudo" required><br><br>
    <input type="email" name="email" placeholder="Adresse email" required><br><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br><br>
    <div id="password-feedback" class="glass-box" style="color: #ff4d4d; display:none; margin-bottom:10px; padding:10px;"></div>
    <div class="glass-box" style="margin-bottom: 15px; padding: 10px;">
        <div style="margin-bottom: 5px;">Sécurité du mot de passe :</div>
        <div style="position: relative; height: 12px; background: rgba(255,255,255,0.05); border-radius: 20px; overflow: hidden;">
            <div id="password-strength-bar" class="strength-bar" style="height: 100%; width: 0%; border-radius: 20px; transition: width 0.4s ease, background-color 0.4s ease;"></div>
        </div>
        <div id="password-strength-label" style="text-align: right; margin-top: 5px; font-size: 0.9em; color: #ccc;"></div>
    </div>
    <input type="password" name="confirm" placeholder="Confirmer le mot de passe" required><br><br>
    <button type="submit" id="submit-btn" disabled>S'inscrire</button>
</form>

<p>Déjà inscrit? <a href="login.php">Connectez-vous</a></p>
</div> <!-- fin app-content -->

<audio id="register-success-sound" src="assets/sounds/register.mp3" preload="auto"></audio>
<div id="register-overlay">👋 Bienvenue, Prisonnier...</div>

<script>
const passwordInput = document.querySelector('input[name="password"]');
const feedback = document.getElementById('password-feedback');
const strengthBar = document.getElementById('password-strength-bar');
const strengthLabel = document.getElementById('password-strength-label');
const submitBtn = document.getElementById('submit-btn');

function updateButtonState(score) {
    if (score >= 3) {
        submitBtn.disabled = false;
        submitBtn.style.opacity = 1;
        submitBtn.style.cursor = "pointer";
    } else {
        submitBtn.disabled = true;
        submitBtn.style.opacity = 0.5;
        submitBtn.style.cursor = "not-allowed";
    }
}

passwordInput.addEventListener('input', () => {
    const pwd = passwordInput.value;
    let score = 0;
    let messages = [];

    if (pwd.length >= 8) score++; else messages.push("8 caractères minimum");
    if (/[A-Z]/.test(pwd)) score++; else messages.push("1 majuscule");
    if (/[a-z]/.test(pwd)) score++; else messages.push("1 minuscule");
    if (/[0-9]/.test(pwd)) score++; else messages.push("1 chiffre");
    if (/[^A-Za-z0-9]/.test(pwd)) score++; else messages.push("1 caractère spécial");

    const colors = ["#ffff33", "#ffcc00", "#ff9900", "#ff6600", "#ff3300", "#ff0000"];
    const labels = ["", "Très faible", "Faible", "Moyen", "Fort", "Optimal"];

    strengthBar.style.width = ((score / 5) * 100) + "%";
    strengthBar.style.backgroundColor = colors[score];
    strengthLabel.textContent = labels[score] ?? "";

    strengthBar.classList.remove('glow-red');
    if (score === 5) strengthBar.classList.add('glow-red');

    feedback.style.display = score < 5 ? "block" : "none";
    if (score < 5) {
        feedback.innerHTML = "Mot de passe trop faible :<br>❌ " + messages.join("<br>❌ ");
    }

    updateButtonState(score);
});
</script>

<?php if (!empty($_SESSION['just_registered']) && !empty($_SESSION['username'])): ?>
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const overlay = document.getElementById('register-overlay');
        const audio = new Audio('assets/sounds/register.mp3');
        const text = "👋 Bienvenue, <?= htmlspecialchars(addslashes($_SESSION['username'])) ?>...";
        let i = 0;
        overlay.textContent = "";

        const typewriter = setInterval(() => {
            if (i < text.length) {
                overlay.textContent += text[i];
                i++;
            } else {
                clearInterval(typewriter);
                overlay.classList.add('fade-out');
                document.getElementById('app-content').style.display = 'none';
                setTimeout(() => {
                    window.location.href = 'home.php';
                }, 100);
            }
        }, 60);

        overlay.classList.add('show');
        audio.play();
    });
</script>
<?php unset($_SESSION['just_registered']); endif; ?>

</body>
</html>
