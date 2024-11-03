<?php 
session_start(); // Assurez-vous que la session est démarrée
include 'header.php'; 
include 'connexionbd.php';

if (!isset($_SESSION['user'])) {
    echo "<p>Vous devez être connecté pour accéder à cette page.</p>";
    include 'footer.php'; 
    exit; // Quitter la page si l'utilisateur n'est pas connecté
}

// Déconnexion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    // Vider la session utilisateur et détruire la session
    session_destroy();
    header('Location: connexion.php');
    exit; // Terminer le script après la redirection
}
?>

<div class="profil" style="text-align: center; margin-top: 20px;">
    <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['user']); ?> !</h1>
    <p>Vous êtes bien connecté.</p>
    <form method="POST" style="display:inline;">
        <button type="submit" name="logout" class="btn">Déconnexion</button>
    </form>

    <h2>Modifier votre mot de passe</h2>
    <form method="GET" action="modifMdp.php">
        <button type="submit" class="btn">Modifier le mot de passe</button>
    </form>
</div>

<?php include 'footer.php'; ?>
