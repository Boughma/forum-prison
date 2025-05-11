function initNotificationsPage() {
  console.log('🔁 JS notifications (ré)initialisé');

  // ✅ Toast
  function showToast(message) {
    const toast = document.createElement("div");
    toast.className = "toast-message";
    toast.innerText = message;
    document.body.appendChild(toast);
    setTimeout(() => toast.classList.add("show"), 10);
    setTimeout(() => {
      toast.classList.remove("show");
      setTimeout(() => toast.remove(), 300);
    }, 2500);
  }

  // ✅ Suppression individuelle
  document.body.addEventListener("click", function (e) {
    if (e.target.matches(".delete-notif-btn")) {
      const btn = e.target;
      const id = btn.dataset.id;
      const el = document.getElementById(`notif-${id}`);
      if (!el) return;

      fetch("notifications.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `ajax=1&delete_id=${id}`
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            el.style.transition = "all 0.3s ease";
            el.style.opacity = "0";
            el.style.height = "0";
            el.style.margin = "0";
            el.style.padding = "0";
            setTimeout(() => {
              el.remove();
              showToast("✅ Notification supprimée !");
            }, 300);
          }
        });
    }
  });

  // ✅ Suppression totale
  const deleteAllBtn = document.getElementById("delete-all-btn");
if (deleteAllBtn) {
  // ⚠️ Annule les anciens écouteurs potentiels
  const newBtn = deleteAllBtn.cloneNode(true);
  deleteAllBtn.parentNode.replaceChild(newBtn, deleteAllBtn);

  newBtn.addEventListener("click", () => {
    if (!confirm("Tout supprimer ?")) return;

    fetch("notifications.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "ajax=1&delete_all=1"
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          document.getElementById("notif-container").innerHTML = "<p style='color:white;'>Aucune notification pour le moment.</p>";
          newBtn.style.display = "none";
          showToast("✅ Toutes supprimées !");
        }
      });
  });
}

}

// ✅ Exécuter immédiatement si la page est chargée classiquement
if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initNotificationsPage);
} else {
  initNotificationsPage();
}
