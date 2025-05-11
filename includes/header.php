<?php require_once __DIR__ . '/head.php'; ?>
<?php
// Début du <body> et affichage de la vidéo de fond
?>
<body>

<div id="glow-border-overlay"></div>

<video autoplay loop muted playsinline preload="auto" id="background-video">
  <source src="/forum-prison/assets/videos/background.webm" type="video/webm">
  <source src="/forum-prison/assets/videos/background.mp4" type="video/mp4">
  Votre navigateur ne supporte pas les vidéos HTML5.
</video>

<div id="page-transition"></div>
<div id="app">
