<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'connexionbdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['mdp'])) {
    $email = trim($_POST['email']);
    $mdp = trim($_POST['mdp']);

    $sql = "SELECT * FROM clients WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $client = $stmt->fetch();

    if ($client && password_verify($mdp, $client['mdp'])) {
        $_SESSION['client_id'] = $client['id'];
        $_SESSION['client_nom'] = $client['nom'];
        header("Location: ../panier.php"); // succès
        exit();
    } else {
        header("Location: ../panier.php?erreur=1"); // échec
        exit();
    }
} else {
    // Accès direct interdit, redirection vers panier
    header("Location: ../panier.php");
    exit();
}
?>


