<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.php'; ?>
<style>
#logout-overlay {
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
  text-align: center;
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
#logout-overlay.show {
  opacity: 1;
  pointer-events: auto;
  animation: overlayZoomGlow 2.5s ease-in-out;
}
#logout-overlay.fade-out {
  opacity: 0;
  transition: opacity 0.1s ease-in-out;
}
</style>
<body>
<div id="logout-overlay"></div>
<audio id="logout-sound" src="assets/sounds/logout.mp3" preload="auto"></audio>

<script>
window.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('logout-overlay');
    const audio = document.getElementById('logout-sound');
    const text = " Déconnexion en cours...";
    let i = 0;
    overlay.textContent = "";

    const typewriter = setInterval(() => {
        if (i < text.length) {
            overlay.textContent += text[i];
            i++;
        } else {
            clearInterval(typewriter);
            overlay.classList.add('fade-out');
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 100);
        }
    }, 60);

    overlay.classList.add('show');
    audio.play();
});
</script>
</body>
</html>
