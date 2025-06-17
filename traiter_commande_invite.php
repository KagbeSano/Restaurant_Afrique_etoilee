<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

// Validation simple
if(empty($data['nom']) || empty($data['email']) || empty($data['adresse']) || empty($data['paiement'])){
    echo json_encode(['success' => false, 'message' => 'Tous les champs sont obligatoires.']);
    exit;
}

// Sanitize input
$nom = filter_var($data['nom'], FILTER_SANITIZE_STRING);
$email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
$adresse = filter_var($data['adresse'], FILTER_SANITIZE_STRING);
$paiement = filter_var($data['paiement'], FILTER_SANITIZE_STRING);

if (!$email) {
    echo json_encode(['success' => false, 'message' => 'Email invalide.']);
    exit;
}

// Ici connexion à la base de données (exemple PDO)
try {
    $pdo = new PDO('mysql:host=localhost;dbname=restaurant_afrique', 'root', ''); // adapte user/mdp/dbname

    // Enregistrer client invité (tu peux créer une table 'clients_invites' par ex)
    $stmt = $pdo->prepare("INSERT INTO clients_invites (nom, email, adresse) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $email, $adresse]);
    $idClient = $pdo->lastInsertId();

    // Enregistrer commande (exemple, adapte selon ta BDD)
    // On suppose que tu récupères le contenu du panier via session ou autre
    session_start();
    if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
        echo json_encode(['success' => false, 'message' => 'Panier vide.']);
        exit;
    }
    $panier = $_SESSION['panier'];

    $stmtCmd = $pdo->prepare("INSERT INTO commandes (client_id, date_commande, adresse_livraison, mode_paiement, statut) VALUES (?, NOW(), ?, ?, 'en attente')");
    $stmtCmd->execute([$idClient, $adresse, $paiement]);
    $idCommande = $pdo->lastInsertId();

    // Enregistrer les détails de la commande
    $stmtDetail = $pdo->prepare("INSERT INTO details_commandes (commande_id, produit_id, quantite, prix_unitaire) VALUES (?, ?, ?, ?)");

    foreach ($panier as $item) {
        $stmtDetail->execute([
            $idCommande,
            $item['id'],          // id produit
            $item['quantite'],
            $item['prix']
        ]);
    }

    // Ici tu peux lancer la procédure de paiement (Stripe, PayPal)
    // Pour l'instant on simule un succès
    // Pour un vrai paiement, tu dois rediriger ou utiliser API Stripe.js

    // Nettoyer le panier après commande
    unset($_SESSION['panier']);

    echo json_encode(['success' => true]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur serveur : ' . $e->getMessage()]);
}
