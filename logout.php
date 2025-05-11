<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.php'; ?>
<?php include('includes/header.php'); ?>

<style>
body {
  background-color: white; /* ou un gris très clair si tu veux */
  transition: background 0.5s ease;
}
#logout-overlay {
  position: fixed;
  inset: 0;
  background: linear-gradient(145deg, #2a2a2a, #1c1c1c, #2f2f2f, #1a1a1a);
  background-blend-mode: multiply;
  color: #f8f8f8;
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
  backdrop-filter: blur(2px); /* effet mat discret */
}

@keyframes overlayZoomGlow {
  0% {
    transform: scale(1);
    text-shadow: 0 0 4px #cccccc, 0 0 10px #eeeeee;
  }
  50% {
    transform: scale(1.03);
    text-shadow: 0 0 12px #ffffff, 0 0 24px #dddddd;
  }
  100% {
    transform: scale(1);
    text-shadow: 0 0 4px #cccccc, 0 0 10px #eeeeee;
  }
}

#logout-overlay.show {
  opacity: 1;
  pointer-events: auto;
  animation: overlayZoomGlow 3s ease-in-out infinite;
}

#logout-overlay.fade-out {
  opacity: 0;
  transition: opacity 0.3s ease-in-out;
}



@keyframes flashFadeInOut {
  0% { opacity: 0; }
  30% { opacity: 1; }
  70% { opacity: 1; }
  100% { opacity: 0; }
}

#flash-overlay {
  position: fixed;
  inset: 0;
  background: white;
  opacity: 0;
  z-index: 10000;
  pointer-events: none;
}

#flash-overlay.show {
  animation: flashFadeInOut 1.5s ease forwards;
}

</style>
<body>
<div id="logout-overlay"></div>
<div id="flash-overlay"></div> <!-- 👈 Flash blanc superposé -->

<audio id="logout-sound" src="assets/sounds/logout.mp3" preload="auto"></audio>

<script>
window.addEventListener('DOMContentLoaded', () => {
  const overlay = document.getElementById('logout-overlay');
  const audio = document.getElementById('logout-sound');
  const text = "Déconnexion en cours...";
  let i = 0;
  overlay.textContent = '';
  overlay.classList.add('show');
  audio.play();

  const flash = document.getElementById('flash-overlay');

const typewriter = setInterval(() => {
  if (i < text.length) {
    overlay.textContent += text[i];
    i++;
  } else {
    clearInterval(typewriter);

    // 🕐 Attendre 1s après texte fini
    setTimeout(() => {
  overlay.remove();
  flash.classList.add('show');

  setTimeout(() => {
    window.location.href = 'index.php';
  }, 700); // redirection pendant le flash encore actif
}, 1000);



  }
}, 100);



});
</script>

</body>
</html>
