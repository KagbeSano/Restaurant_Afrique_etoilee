// Récupération du panier depuis le localStorage (ou tableau vide si aucun)
let panier = JSON.parse(localStorage.getItem("panier")) || [];

// Appelé au chargement de la page
document.addEventListener("DOMContentLoaded", () => {
  mettreAJourBadge();
  afficherPanier(); // Optionnel : seulement si listePanier existe
});

// Fonction pour ajouter un produit au panier
function ajouterAuPanierDepuisModal() {
  const titre = document.getElementById("modalTitle").textContent;
  const image = document.getElementById("modalImage").src;
  const description = document.getElementById("modalDescription").textContent;
  const prix = document.getElementById("modalPrix").textContent;

  const produit = { titre, image, description, prix };

  panier.push(produit);
  localStorage.setItem("panier", JSON.stringify(panier));

  mettreAJourBadge();
  alert(`"${titre}" ajouté au panier !`);
}

// Met à jour le badge rouge avec le nombre d’articles
function mettreAJourBadge() {
  const badge = document.getElementById("panierBadge");
  if (badge) {
    badge.textContent = panier.length;
    badge.style.display = panier.length > 0 ? "inline-block" : "none";
  }
}

// Affiche la liste des produits (ex: dans panier.html)
function afficherPanier() {
  const liste = document.getElementById("listePanier");
  if (!liste) return;

  liste.innerHTML = "";
  panier.forEach((item, index) => {
    const li = document.createElement("li");
    li.innerHTML = `
      <div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
        <img src="${item.image}" alt="${item.titre}" style="width: 60px; height: auto; border-radius: 5px;">
        <div>
          <strong>${item.titre}</strong><br>
          <small>${item.prix}</small>
        </div>
        <button onclick="supprimerDuPanier(${index})" style="margin-left:auto; color:red;">❌</button>
      </div>
    `;
    liste.appendChild(li);
  });
}

// Supprime un article du panier
function supprimerDuPanier(index) {
  panier.splice(index, 1);
  localStorage.setItem("panier", JSON.stringify(panier));
  afficherPanier();
  mettreAJourBadge();
}

// Vide tout le panier
function viderPanier() {
  if (confirm("Voulez-vous vraiment vider le panier ?")) {
    panier = [];
    localStorage.removeItem("panier");
    afficherPanier();
    mettreAJourBadge();
  }
}
function getTotalPanier() {
  return panier.reduce((total, item) => {
    let prix = parseFloat(item.prix.replace(/[^\d.]/g, ""));
    return total + (isNaN(prix) ? 0 : prix);
  }, 0);
}

