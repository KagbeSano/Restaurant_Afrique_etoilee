<?php
// Connexion à la base de données avec PDO
$serveur = "localhost";
$dbname = "restaurant";
$user = "root";
$pass = "";
 
 $pdo = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", $user, $pass);

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
$datetime_resa_raw = $_POST['datetime_resa']; // ex: 2025-06-08T20:00
$datetime_resa = str_replace("T", " ", $datetime_resa_raw);
$nombre_personnes = intval($_POST['nombre_personnes']);
$description = $_POST['description'];
// Préparer et exécuter la requête SQL
$sql = "INSERT INTO reservations (nom, email, datetime_resa, nombre_personnes,description)
        VALUES (:nom, :email, :datetime_resa, :nombre_personnes, :description)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'nom' => $nom,
    'email' => $email,
    'datetime_resa' => $datetime_resa,
    'nombre_personnes' => $nombre_personnes,
    'description' => $description,
]);

echo "Réservation enregistrée avec succès !";
?>
