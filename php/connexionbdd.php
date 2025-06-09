<?php
$serveur = "localhost";
$dbname = "restaurant";
$user = "root";
$pass = "";
 
//  $pdo = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", $user, $pass);

 try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connexion réussie avec PDO.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!-- Formulaire HTML simple -->
<!-- <form method="post">
    Email : <input type="email" name="email" required><br>
    Mot de passe : <input type="password" name="mdp" required><br>
    <button type="submit">Se connecter</button>
</form> -->

