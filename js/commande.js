document.getElementById("btnCommander").addEventListener("click", () => {
  fetch("verifier_session.php")
    .then(r => r.json())
    .then(data => {
      if (data.connecte) {
        envoyerCommande(data.client_id); // connecté
      } else {
        // Afficher le choix dans une alerte personnalisée
        if (confirm("Vous n’êtes pas connecté.\n\nSouhaitez-vous vous connecter ?\n\nAppuyez sur Annuler pour commander en tant qu'invité.")) {
          window.location.href = "connexion.php";
        } else {
          envoyerCommande(null); // invité
        }
      }
    });
});

function envoyerCommande(clientId = null) {
  const panier = JSON.parse(localStorage.getItem("panier") || "{}");
  const adresse = document.getElementById("adresse").value.trim();

  if (!adresse) {
    alert("Veuillez entrer votre adresse de livraison.");
    return;
  }

  fetch("validation_commande.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      panier: panier,
      adresse: adresse,
      client_id: clientId
    })
  })
    .then(r => r.text())
    .then(msg => {
      alert(msg);
      localStorage.removeItem("panier");
      location.reload();
    })
    .catch(err => alert("Erreur : " + err));
}

