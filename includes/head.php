<head>
<style>
  html, body {
    background-color: black;
    color: white;
  }
  * {
    transition: none !important;
  }
</style>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Forum des prisonniers' ?></title>
<link rel="stylesheet" href="assets/css/style.css">

  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;700&display=swap" rel="stylesheet">
<style>
  body {
    font-family: 'Rajdhani', sans-serif;
  }
</style>
<script>
    window.addEventListener("DOMContentLoaded", () => {
      document.body.classList.add("fade-in");
    });
  </script>

  <!-- Citations toujours chargées, nécessaires pour index.php -->
  <script src="/forum-prison/assets/js/citations.js" defer></script>
  <script src="/forum-prison/assets/js/parallax.js" defer></script>
  <script src="/forum-prison/assets/js/transition.js" defer></script>
</head>
