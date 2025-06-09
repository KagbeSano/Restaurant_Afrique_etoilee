<?php
// Connexion à la base de données avec PDO
$serveur = "localhost";
$dbname = "restaurant";
$user = "root";
$pass = "";
 
try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", $user, $pass);
    // Activer les erreurs PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connexion échouée : " . $e->getMessage());
}

// Récupération des données du formulaire
$nom = $_POST['nom'];
$email = $_POST['email'];
$sujet = $_POST['sujet'];
$message = $_POST['message'];
// Préparer et exécuter la requête SQL
$sql = "INSERT INTO contact (nom, email, sujet, message) 
        VALUES (:nom, :email, :sujet, :message)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'nom' => $nom,
    'email' => $email,
    'sujet' => $sujet,
    'message' => $message,
]);

echo "message envoyer avec succès !";
?>
