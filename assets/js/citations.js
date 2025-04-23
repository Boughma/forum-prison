document.addEventListener('DOMContentLoaded', () => {
  const quoteEl = document.getElementById("quote");

  const quotes = [
    "« On peut enfermer le corps, mais jamais l’esprit. » – Nelson Mandela",
    "« La liberté, c’est ce que l’on fait avec ce qui nous a été fait. » – Jean-Paul Sartre",
    "« Derrière les barreaux, l’encre devient une clé. » – Inconnu",
    "« Celui qui ouvre une porte d’école, ferme une prison. » – Victor Hugo",
    "« La parole libère, même quand le silence enferme. » – Inconnu",
    "« Tant qu’il y aura de la mémoire, il y aura de l’espoir. » – Primo Levi",
    "« Même enchaîné, celui qui pense est libre. » – Sénèque"
  ];

  let quotePool = [...quotes];

  function getNextQuote() {
    if (quotePool.length === 0) quotePool = [...quotes];
    const index = Math.floor(Math.random() * quotePool.length);
    const quote = quotePool[index];
    quotePool.splice(index, 1);
    return quote;
  }

  function showQuote(text) {
    quoteEl.style.opacity = 0;
    setTimeout(() => {
      quoteEl.textContent = text;
      quoteEl.style.opacity = 1;
      quoteEl.style.transform = "translateY(0)";
    }, 400);
  }

  showQuote(getNextQuote());

  setInterval(() => {
    showQuote(getNextQuote());
  }, 9000);
});
