<?php 
// Vérifie si une recherche a été faite
if (isset($_GET['nomDuRestaurant'])) {
    $searchTerm = htmlspecialchars($_GET['nomDuRestaurant']); 
    header("Location: ../pages/listerestaurant.php?search=" . urlencode($searchTerm));
    exit;
}
?>

<form method="GET">
    <input id="rechercheResto" type="text" name="nomDuRestaurant" placeholder="Rechercher un restaurant" />
    <input type="submit" value="Rechercher" />
</form>
