<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");

if (!isset($_SESSION['client_id'])) {
    http_response_code(401);
    echo "Non connecté";
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);
$panier = $input['panier'] ?? [];
$adresse = $input['adresse'] ?? '';

if (empty($panier)) {
    echo "Panier vide.";
    exit;
}

$stmt = $pdo->prepare("INSERT INTO commandes (client_id, adresse_livraison) VALUES (?, ?)");
$stmt->execute([$_SESSION['client_id'], $adresse]);
$commande_id = $pdo->lastInsertId();

$stmt_detail = $pdo->prepare("INSERT INTO details_commande (commande_id, plat_id, quantite) VALUES (?, ?, ?)");
foreach ($panier as $id_plat => $quantite) {
    $stmt_detail->execute([$commande_id, $id_plat, $quantite]);
}

echo "Commande enregistrée avec succès.";
