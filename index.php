<?php
session_start();
require_once 'includes/db.php';

$pageTitle = "Accueil - Forum des prisonniers";
?>

<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.php'; ?>
<body>
    
<div id="page-transition"></div>



<div class="glass-box">
<section class="slider-scene">
  <div class="parallax-layer layer-bg"></div>
  <div class="parallax-layer layer-glow"></div>
  <div class="parallax-layer layer-quote">
    <blockquote id="quote" class="animated-quote"></blockquote>
  </div>
  
</section>

    <blockquote id="quote"></blockquote>
    <div style="text-align:center; margin-top:30px;">
        <a href="login.php"><button>Connexion</button></a>
        <a href="register.php"><button>S'inscrire</button></a>

        
    </div>
</div>

<section class="a-propos">
  <h2>À propos</h2>
  <p>
    Ce forum est un espace libre de discussions pour les personnes incarcérées ou isolées.
    Ici, la parole circule, les histoires se racontent, les soutiens se construisent. Anonymat garanti.
  </p>
</section>



    
</div>





<?php include 'includes/footer.php'; ?>



</body>
</html>
