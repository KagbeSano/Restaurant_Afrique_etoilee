<?php
// 1. Connexion à la BDD (PDO)
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

// 2. Récupération des données du formulaire
$nom = $_POST['nom'] ?? '';
$profession = $_POST['profession'] ?? '';
$commentaire = $_POST['commentaire'] ?? '';
$note = intval($_POST['note'] ?? 0);

// 3. Gestion de l’upload de la photo
$photo_path = null; // par défaut pas de photo

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/../images/photo/'; // chemin absolu vers dossier images/temoignages/
    
    // Vérifie que le dossier existe, sinon le créer
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $tmpName = $_FILES['photo']['tmp_name'];
    $originalName = basename($_FILES['photo']['name']);
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    
    // Valide l’extension (exemple : jpg, jpeg, png, gif)
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($extension, $allowedExtensions)) {
        die("Erreur : format de fichier non supporté.");
    }
    
    // Crée un nouveau nom unique pour éviter conflits
    $newFileName = uniqid('avis_') . '.' . $extension;
    $destination = $uploadDir . $newFileName;
    
    // Déplace le fichier
    if (!move_uploaded_file($tmpName, $destination)) {
        die("Erreur lors du déplacement du fichier.");
    }
    
    // Chemin relatif à sauvegarder en base, depuis la racine du site
    $photo_path = 'images/temoignages/' . $newFileName;
}

// 4. Insertion en base
$sql = "INSERT INTO avis (nom, profession, commentaire, note, photo) 
        VALUES (:nom, :profession, :commentaire, :note, :photo)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':nom' => $nom,
    ':profession' => $profession,
    ':commentaire' => $commentaire,
    ':note' => $note,
    ':photo' => $photo_path
]);

echo "Merci pour votre avis !";
?>
