<?php
session_start();
require(connexion.php)

$date_commande = date('Y-m-d H:i:s');

// Création de la commande
if (isset($_SESSION['client_id'])) {
    $stmt = $conn->prepare("INSERT INTO commandes (client_id, date_commande) VALUES (?, ?)");
    $stmt->execute([$_SESSION['client_id'], $date_commande]);
} else {
    $stmt = $conn->prepare("INSERT INTO commandes (nom_invite, telephone_invite, adresse_livraison, date_commande) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_POST['nom_invite'],
        $_POST['telephone_invite'],
        $_POST['adresse_livraison'],
        $date_commande
    ]);
}

$commande_id = $conn->lastInsertId();

// Insérer tous les plats commandés (quantité > 0)
foreach ($_POST['plats'] as $plat_id => $quantite) {
    if ($quantite > 0) {
        $stmt = $conn->prepare("INSERT INTO details_commande (commande_id, plat_id, quantite) VALUES (?, ?, ?)");
        $stmt->execute([$commande_id, $plat_id, $quantite]);
    }
}
?>

<div class="container mt-5">
    <div class="alert alert-success">
        Commande enregistrée avec succès !
    </div>

    <?php if (!isset($_SESSION['client_id'])): ?>
        <div class="alert alert-info">
            Vous avez commandé en tant qu'invité.<br>
            <a href="inscription.php" class="btn btn-outline-primary">Créer un compte pour suivre vos commandes</a>
        </div>
    <?php endif; ?>
</div>
