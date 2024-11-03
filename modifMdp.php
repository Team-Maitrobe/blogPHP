<?php 
include 'header.php'; 
include 'connexionbd.php'; // Inclure la connexion à la base de données
if (!isset($_SESSION['user'])) {
    echo "<p>Vous devez être connecté pour accéder à cette page.</p>";
    include 'footer.php'; 
    exit; // Quitter la page si l'utilisateur n'est pas connecté
}

// Changement de mot de passe
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $pseudo = $_SESSION['user'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Vérifiez que les nouveaux mots de passe correspondent
    if ($new_password !== $confirm_password) {
        echo "<p style='color: red;'>Les nouveaux mots de passe ne correspondent pas.</p>";
    } else {
        // Vérifiez l'ancien mot de passe dans la base de données
        try {
            // Préparer la requête pour récupérer le mot de passe actuel
            $stmt = $pdo->prepare('SELECT mot_de_passe FROM FOUFOOD.UTILISATEUR WHERE pseudo = :pseudo');
            $stmt->execute(['pseudo' => $pseudo]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifiez si l'ancien mot de passe est correct
            if (password_verify($old_password, $user['mot_de_passe'])) {
                // Mettre à jour le mot de passe
                $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
                $update_stmt = $pdo->prepare('UPDATE FOUFOOD.UTILISATEUR SET mot_de_passe = :new_password WHERE pseudo = :pseudo');
                $update_stmt->execute(['new_password' => $new_password_hashed, 'pseudo' => $pseudo]);
                echo "<p style='color: green;'>Mot de passe modifié avec succès !</p>";
            } else {
                echo "<p style='color: red;'>Ancien mot de passe incorrect.</p>";
            }
        } catch (PDOException $e) {
            echo "<p style='color: red;'>Erreur lors de la mise à jour du mot de passe : " . $e->getMessage() . "</p>";
        }
    }
}
?>

<div class="modifMDP" style="text-align: center; margin-top: 20px;">
    <h2>Changer votre mot de passe</h2>
    <form method="POST">
        <label for="old_password">Ancien mot de passe :</label><br>
        <input type="password" id="old_password" name="old_password" required><br>
        <label for="new_password">Nouveau mot de passe :</label><br>
        <input type="password" id="new_password" name="new_password" required><br>
        <label for="confirm_password">Confirmer le nouveau mot de passe :</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br>
        <button type="submit" name="change_password" class="btn">Modifier le mot de passe</button>
    </form>
    <a href="profil.php">Annuler</a>
</div>

<?php include 'footer.php'; ?>
