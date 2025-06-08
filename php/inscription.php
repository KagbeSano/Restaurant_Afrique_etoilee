<?php
$nom = $_POST['nom_invite'] ?? '';
$email = $_POST['email'] ?? '';
?>

<form method="POST" action="enregistrer_client.php" class="container mt-5">
    <h2>Créer un compte</h2>
    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($nom) ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Mot de passe</label>
        <input type="password" name="mot_de_passe" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Créer mon compte</button>
</form>
