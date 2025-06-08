<?php
session_start();
$serveur = "localhost";
$dbname = "restaurant";
$user = "root";
$pass = "";
 
 $pdo = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", $user, $pass);

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $stmt = $pdo->prepare("SELECT * FROM clients WHERE email = ?");
    $stmt->execute([$email]);
    $client = $stmt->fetch();

    if ($client && password_verify($mdp, $client['mdp'])) {
        $_SESSION['client_id'] = $client['id'];
        $_SESSION['client_nom'] = $client['nom'];

        // Rediriger vers le panier pour valider la commande
        header("Location: panier.php");
        exit;
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}

// try {
//     $pdo = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", $user, $pass);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     echo "Connexion réussie avec PDO.";
// } catch (PDOException $e) {
//     echo "Erreur : " . $e->getMessage();
// }
// ?>

<!-- Formulaire HTML simple -->
<form method="post">
    Email : <input type="email" name="email" required><br>
    Mot de passe : <input type="password" name="mdp" required><br>
    <button type="submit">Se connecter</button>
</form>

