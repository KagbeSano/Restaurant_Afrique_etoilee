// Récupération du panier depuis le localStorage (ou tableau vide si aucun)
let panier = JSON.parse(localStorage.getItem("panier")) || [];
console.log("📦 Script panier.js chargé");
// Fonction pour ajouter un produit au panier
function ajouterAuPanierDepuisModal() {
  // console.log("ajouterAuPanierDepuisModal() appelée"); // <--- AJOUTE ÇA
  const titre = document.getElementById("modalTitle").textContent;
  const image = document.getElementById("modalImage").src;
  const description = document.getElementById("modalDescription").textContent;
  const prix = document.getElementById("modalPrix").textContent;

  const produit = { titre, image, description, prix };
  // console.log({ titre, image, description, prix }); // <--- AJOUTE ÇA

  panier.push(produit);
  localStorage.setItem("panier", JSON.stringify(panier));

  mettreAJourBadge();
  // alert(`"${titre}" ajouté au panier !`);
}
// Met à jour le badge rouge avec le nombre d’articles
function afficherPanier() {
  const liste = document.getElementById("listePanier");
  const totalDiv = document.getElementById("totalPanier");
  if (!liste || !totalDiv) {
    console.error("⚠️ Élément #listePanier ou #totalPanier introuvable dans le DOM !");
    return;
  }
console.log('listePanier élément:', document.getElementById("listePanier"));
  liste.innerHTML = "";
  let total = 0;

  if (panier.length === 0) {
    liste.innerHTML = '<tr><td colspan="6">Votre panier est vide 😢</td></tr>';
    totalDiv.textContent = "0 €";
    return;
  }

  panier.forEach((item, index) => {
    console.log("Item:", item);
     const prixUnitaire = parseFloat(
    item.prix.replace(/\s/g, "").replace("€", "").replace(",", ".")) || 0;
    console.log("Prix unitaire :", prixUnitaire); // 👈 pour vérifier la conversion
    const quantite = item.quantite || 1;
    const sousTotal = prixUnitaire * quantite;
    total += sousTotal;

    const row = document.createElement("tr");
    row.innerHTML = `
      <td><img src="${item.image}" alt="${item.titre}" style="width: 80px;"></td>
      <td>${item.titre}</td>
      <td>${prixUnitaire.toFixed(2)} €</td>
      <td>
        <button class="btn btn-sm btn-outline-secondary me-1" onclick="modifierQuantite(${index}, -1)">-</button>
        ${quantite}
        <button class="btn btn-sm btn-outline-secondary ms-1" onclick="modifierQuantite(${index}, 1)">+</button>
      </td>
      <td>${sousTotal.toFixed(2)} €</td>
      <td><button class="btn btn-sm btn-danger" onclick="supprimerDuPanier(${index})">🗑️</button></td>
    `;
    liste.appendChild(row);
  });

  totalDiv.textContent = `${total.toFixed(2)} €`;
}
// Supprime un article du panier
function supprimerDuPanier(index) {
  panier.splice(index, 1);
  localStorage.setItem("panier", JSON.stringify(panier));
  afficherPanier();
}

// Vide tout le panier
function viderPanier() {
  if (confirm("Voulez-vous vraiment vider le panier ?")) {
    panier = [];
    localStorage.removeItem("panier");
    afficherPanier();
  }
}
function getTotalPanier() {
  return panier.reduce((total, item) => {
    let prix = parseFloat(item.prix.replace(/[^\d.]/g, ""));
    return total + (isNaN(prix) ? 0 : prix);
  }, 0);
}

// Fonction pour incrémenter le nombre de produits dans le badge
function mettreAJourBadge() {
  const badge = document.getElementById("panierBadge");
  if (!badge) return;

  const count = panier.length;
  badge.textContent = count;
  badge.style.display = count > 0 ? "inline-block" : "none";
}

// modifier la quantité
function modifierQuantite(index, delta) {
  if (!panier[index].quantite) panier[index].quantite = 1;
  panier[index].quantite += delta;
  if (panier[index].quantite <= 0) {
    panier.splice(index, 1);
  }
  localStorage.setItem("panier", JSON.stringify(panier));
  afficherPanier();
}
document.addEventListener("DOMContentLoaded", () => {
  panier = JSON.parse(localStorage.getItem("panier")) || [];

  const bouton = document.getElementById("ajouterAuPanierBtn");
  if (bouton) {
    // Avant d’ajouter l'événement, on supprime tous les anciens (optionnel mais sûr)
    bouton.replaceWith(bouton.cloneNode(true)); // reset total du bouton
    document.getElementById("ajouterAuPanierBtn").addEventListener("click", ajouterAuPanierDepuisModal);
  }

  const liste = document.getElementById("listePanier");
  const totalDiv = document.getElementById("totalPanier");

  if (liste && totalDiv) {
    afficherPanier();
  } else {
    console.log("✅ panier.js chargé — pas de panier à afficher sur cette page.");
  }

  mettreAJourBadge();
});
