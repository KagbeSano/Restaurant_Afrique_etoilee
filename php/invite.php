<?php
session_start();
require 'connexionbdd.php';
// Vérifie si les champs sont bien remplis
if (!empty($_POST['name']) && !empty($_POST['email'])) {
    $nom = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    // Enregistre temporairement les infos en session
    $_SESSION['guest_nom'] = $nom;
    $_SESSION['guest_email'] = $email;

    // Ici tu pourrais sauvegarder la commande dans la base de données ou envoyer un email, etc.

    // Redirection vers une page de confirmation (ou la page panier avec message)
    header("Location: ../confirmation.php"); // à créer
    exit;
} else {
    // Redirection avec erreur
    header("Location: ../panier.php?erreur_guest=1");
    exit;
}
