<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'connexionbdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'], $_POST['email'], $_POST['telephone'], $_POST['mdp'])) {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $telephone = trim($_POST['telephone']);
    $mdp = password_hash(trim($_POST['mdp']), PASSWORD_DEFAULT);

    // Vérifie si l'email existe déjà
    $stmt = $pdo->prepare("SELECT id FROM clients WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        header("Location: ../panier.html?erreur=existe");
        exit();
    }

    // Insère le nouveau client
    $stmt = $pdo->prepare("INSERT INTO clients (nom, email, telephone, mdp) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $email, $telephone, $mdp]);

    $_SESSION['client_id'] = $pdo->lastInsertId();
    $_SESSION['client_nom'] = $nom;

    header("Location: ../panier.html?inscription=ok");
    exit();
} else {
    header("Location: ../panier.html?erreur=donnees");
    exit();
}
?>
