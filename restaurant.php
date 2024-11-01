<?php 
include 'header.php'; 
include 'connexionbd.php'; // Assurez-vous que la connexion est correcte
?>

<main>
    <?php
    // Vérifie si les paramètres 'restaurant' et 'adresse' existent dans l'URL
    if (isset($_GET['restaurant']) && isset($_GET['adresse'])) {
        $idresto = $_GET['restaurant'];
        $adresse = $_GET['adresse'];

        try {
            // Prépare et exécute la requête pour récupérer le nom du restaurant
            $sql = 'SELECT nom_resto FROM FOUFOOD.RESTAURANT WHERE id_resto = :idresto';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['idresto' => $idresto]);
            
            // Récupère le nom du restaurant
            $nomDuRestaurant = $stmt->fetchColumn();

            if ($nomDuRestaurant) {
                echo "<h1>Restaurant : " . htmlspecialchars($nomDuRestaurant) . "</h1>";
            } else {
                echo "<p>Restaurant non trouvé.</p>";
            }
        } catch (PDOException $e) {
            echo "<p>Erreur : " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>Paramètres d'URL manquants.</p>";
    }
    ?>
</main>

<?php include 'footer.php'; ?>
