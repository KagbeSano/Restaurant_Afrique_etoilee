<?php
session_start();
$serveur = "localhost";
$dbname = "restaurant";
$user = "root";
$pass = "";
 
 $pdo = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", $user, $pass);

$input = json_decode(file_get_contents("php://input"), true);
$panier = $input['panier'] ?? [];
$adresse = $input['adresse'] ?? '';
$client_id = $input['client_id'] ?? ($_SESSION['client_id'] ?? null); // priorité au POST

if (empty($panier)) {
    echo "Panier vide.";
    exit;
}

if (!$adresse) {
    echo "Adresse manquante.";
    exit;
}

// Insertion commande
$stmt = $pdo->prepare("INSERT INTO commandes (client_id, adresse_livraison) VALUES (?, ?)");
$stmt->execute([$client_id, $adresse]);
$commande_id = $pdo->lastInsertId();

// Insertion détails
$stmt_detail = $pdo->prepare("INSERT INTO details_commande (commande_id, plat_id, quantite) VALUES (?, ?, ?)");
foreach ($panier as $id_plat => $quantite) {
    $stmt_detail->execute([$commande_id, $id_plat, $quantite]);
}

echo $client_id
  ? "Commande enregistrée avec succès (client connecté)."
  : "Commande enregistrée en mode invité.";
?>