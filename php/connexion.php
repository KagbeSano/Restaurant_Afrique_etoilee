<?php
$serveur = "localhost";
$dbname = "restaurant";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connexion réussie avec PDO.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
