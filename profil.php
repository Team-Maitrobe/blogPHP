<?php 
    include 'header.php';
    session_start();
?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
        // Clear the user session on logout
        $_SESSION['user'] = '';
        session_destroy(); // Optionally destroy the session
        header('Location: connexion.php');
    }
?>
<p>Bienvenue, <?php echo htmlspecialchars($_SESSION['user']); ?> ! Vous êtes bien connecté.</p>
<form method="POST" style="display:inline;">
    <input type="submit" name="logout" value="Deconnexion">
    
</form>
<?php include 'footer.php' ?>