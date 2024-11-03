<?php 
// Vérifie si une recherche a été faite
if (isset($_GET['pseudo'])) {
    $searchTerm = htmlspecialchars($_GET['pseudo']); 
    header("Location: ./touslesposts.php?search=" . urlencode($searchTerm));
    exit;
}
?>

<form method="GET">
    <input id="recherchePseudo" type="text" name="pseudo" placeholder="Rechercher un pseudo" />
    <input type="submit" value="Rechercher" />
</form>
