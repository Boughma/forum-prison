document.addEventListener('DOMContentLoaded', () => {
    const transition = document.getElementById('page-transition');
  
    // Lien cliqué
    document.querySelectorAll('a[href]').forEach(link => {
      const url = link.getAttribute('href');
      if (!url.startsWith('#') && !url.startsWith('javascript') && !url.includes('logout')) {
        link.addEventListener('click', (e) => {
          e.preventDefault();
          document.body.classList.add('transition-out');
  
          setTimeout(() => {
            window.location.href = url;
          }, 600); // Temps synchronisé avec CSS
        });
      }
    });
  
    // Effet d'entrée
    setTimeout(() => {
      document.getElementById('page-transition').style.display = 'none';
    }, 600);
  });
  