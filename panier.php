<?php
session_start();
?>
<?php if (isset($_SESSION['client_nom'])): ?>
  <p>Bienvenue <?= htmlspecialchars($_SESSION['client_nom']) ?></p>
<?php else: ?>
  <p>Bonjour, veuillez vous connecter.</p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Restaurant Afrique étoilée </title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  <style>
    /* .panier-img {
      width: 80px;
      height: auto;
    }

    .quantite-btn {
      width: 32px;
      height: 32px;
      text-align: center;
      padding: 0;
    } */
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }

    #listePanier li {
      margin-bottom: 10px;
    }

    #totalPanier {
      font-weight: bold;
      margin-top: 20px;
      font-size: 18px;
    }

    button {
      padding: 8px 12px;
      border: none;
      background-color: #dc3545;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="image/logo.png" alt="logo" style="width: 50px; height:50px;"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item "><a class="nav-link active" style="color: white;" href="index.html">Accueil</a></li>
          <!-- <li class="nav-item"><a class="nav-link" style="color: white;" href="panier.html"><i class="bi bi-cart"></i> -->
          </a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-5">
    <h2 class="mb-4">Mon Panier</h2>

    <table class="table table-bordered align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th>Image</th>
          <th>Nom</th>
          <th>Prix</th>
          <th>Quantité</th>
          <th>Sous-total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="listePanier">

      </tbody>
    </table>
    <div class="text-end">
      <h4>Total : <span id="totalPanier">0 €</span></h4>
      <div class="mb-3">
  <!-- <label for="adresse" class="form-label">Adresse de livraison</label>
  <textarea id="adresse" class="form-control" placeholder="Ex: 12 rue de l'Afrique, Dakar" required></textarea> -->
</div>

      <button class="btn btn-danger" onclick="viderPanier()">Vider le panier</button>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#commandeModal">
  Commander
</button>

    </div>

    <a href="menu.html">
      <div>
        <button class="btn btn-primary" style="width:250px; padding: 10px 20px;  border: none; border-radius: 10px;">
          ← Retour au menu
        </button>
      </div>
    </a>
  </div>
<!-- data-bs-toggle="modal" data-bs-target="#commandeModal" -->
   <!-- <div class="container my-5">

    <h1 class="text-center mb-4">🛒 Mon Panier</h1>

    <ul id="listePanier" class="list-group mb-4">
  
    </ul>

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 id="totalPanier" class="m-0">Total : 0 €</h4>
      <button class="btn btn-danger" onclick="viderPanier()">Vider le panier</button>
    </div>

    <div class="text-center">
      <a href="menu.html" class="btn btn-secondary">← Retour au menu</a>
    </div>
  </div>  -->
  <script src="js/panier.js" defer></script>
  <script src="js/commande.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- debut formulaire modal -->
   <div class="modal fade" id="commandeModal" tabindex="-1" aria-labelledby="commandeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commandeModalLabel">Finaliser la commande</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="commandeTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">Se connecter</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab">Créer un compte</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="guest-tab" data-bs-toggle="tab" data-bs-target="#guest" type="button" role="tab">Commander en invité</button>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content pt-3">
          <!-- Se connecter -->
          <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
            <?php if (isset($_GET['erreur']) && $_GET['erreur'] == 1): ?>
             <div class="alert alert-danger">
               Email ou mot de passe incorrect.
             </div>
            <?php endif; ?>

            <!-- <div id="messageErreurConnexion" style="color: red; margin-bottom: 10px;"></div> -->
            <form action="php/login.php" method="post">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="mdp" name="mdp" required>
              </div>
              <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
          </div>

          <!-- Créer un compte -->
          <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
            <form action="php/inscription.php" method="post">
              <div class="mb-3">
                <label for="nom" class="form-label">Nom complet</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="mb-3">
                <label for="telephone" class="form-label">Telephone</label>
                <input type="tel" class="form-control" id="telephone" placeholder="06XXXXXXXX" name="telephone" pattern="[0-9]{10}" required>
              </div>
              <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="mdp" name="mdp" required>
              </div>
              <button type="submit" class="btn btn-success">Créer un compte</button>
            </form>
          </div>

          <!-- Commander en invité -->
          <div class="tab-pane fade" id="guest" role="tabpanel" aria-labelledby="guest-tab">
            <form action="php/invite.php" method="POST">
              <div class="mb-3">
                <label for="guestName" class="form-label">Nom complet</label>
                <input type="text" class="form-control" id="guestName" name="name" required>
              </div>
              <div class="mb-3">
                <label for="guestEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="guestEmail" name="email" required>
              </div>
              <button type="submit" class="btn btn-warning">Passer la commande</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
  <!-- le modal pour finaliser la commande -->
 <div class="modal fade" id="modalFinalCommande" tabindex="-1" aria-labelledby="modalFinalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formFinalCommande">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalFinalLabel">Finaliser la commande</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="adresseLivraison" class="form-label">Adresse de livraison</label>
            <textarea class="form-control" id="adresseLivraison" name="adresse" required></textarea>
          </div>
          <div class="mb-3">
            <label for="paiement" class="form-label">Choisir le mode de paiement</label>
            <select class="form-select" id="paiement" name="paiement" required>
              <option value="">Sélectionnez...</option>
              <option value="cb">Carte bancaire</option>
              <option value="paypal">PayPal</option>
              <option value="bitcoin">Bitcoin (juste pour tester 😉)</option>
            </select>
          </div>
          <!-- Tu peux ajouter ici des champs spécifiques au paiement si besoin -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
          <button type="submit" class="btn btn-success">Valider et payer</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- fin du modal pour finaliser la commande -->
<script>
   document.getElementById('formFinalCommande').addEventListener('submit', function(event) {
  event.preventDefault();

  const adresse = document.getElementById('adresseLivraison').value.trim();
  const paiement = document.getElementById('paiement').value;

  if (!adresse) {
    alert('Veuillez saisir une adresse de livraison.');
    return;
  }
  if (!paiement) {
    alert('Veuillez choisir un mode de paiement.');
    return;
  }

  // Préparer les données à envoyer, y compris invité
  const data = {
    nom: document.getElementById('guestName').value,
    email: document.getElementById('guestEmail').value,
    adresse: adresse,
    paiement: paiement
  };

  fetch('php/traiter_commande_invite.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  })
  .then(response => response.json())
  .then(result => {
    if(result.success){
      alert('Commande validée avec succès !');
      const modalFinal = bootstrap.Modal.getInstance(document.getElementById('modalFinalCommande'));
      if (modalFinal) modalFinal.hide();
      const modalCommande = bootstrap.Modal.getInstance(document.getElementById('commandeModal'));
      if (modalCommande) modalCommande.hide();
      document.getElementById('formInvite').reset();
      document.getElementById('formFinalCommande').reset();
      // Ici tu peux rediriger ou faire autre chose
    } else {
      alert('Erreur : ' + result.message);
    }
  })
  .catch(error => {
    alert('Erreur serveur, merci de réessayer plus tard.');
    console.error(error);
  });
});

</script>

</body>

</html>