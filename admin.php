<?php
include 'header.php';
include 'connexionbd.php'; // Assurez-vous que la connexion à la BD est correcte

// Vérifier si l'utilisateur est connecté et a le statut d'administrateur
if (!isset($_SESSION['user']) || $_SESSION['admin'] != 1) {
    echo "<p>Accès refusé. Cette page est réservée aux administrateurs.</p>";
    include 'footer.php';
    exit;
}

// Affiche un message de confirmation
if (isset($_GET['message'])) {
    echo "<p>" . htmlspecialchars($_GET['message']) . "</p>";
}

// Supprimer un restaurant
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_restaurant_id'])) {
    $deleteRestaurantId = $_POST['delete_restaurant_id'];
    
    try {
        // Supprimer le restaurant
        $stmtDelete = $pdo->prepare('DELETE FROM FOUFOOD.RESTAURANT WHERE id_resto = :id');
        $stmtDelete->execute(['id' => $deleteRestaurantId]);
        
        header("Location: admin.php?message=Restaurant supprimé avec succès.");
        exit;
    } catch (PDOException $e) {
        echo "<p>Erreur lors de la suppression du restaurant : " . $e->getMessage() . "</p>";
    }
}

// Modifier le nom du restaurant
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_restaurant_id'])) {
    $editRestaurantId = $_POST['edit_restaurant_id'];
    $newRestaurantName = $_POST['new_name'];
    
    try {
        // Mettre à jour le nom du restaurant
        $stmtUpdate = $pdo->prepare('UPDATE FOUFOOD.RESTAURANT SET nom_resto = :newName WHERE id_resto = :id');
        $stmtUpdate->execute(['newName' => $newRestaurantName, 'id' => $editRestaurantId]);
        
        header("Location: admin.php?message=Nom du restaurant modifié avec succès.");
        exit;
    } catch (PDOException $e) {
        echo "<p>Erreur lors de la modification du restaurant : " . $e->getMessage() . "</p>";
    }
}

try {
    // Récupérer tous les restaurants
    $stmt = $pdo->query('SELECT id_resto, nom_resto FROM FOUFOOD.RESTAURANT ORDER BY nom_resto ASC');
    $restaurants = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Gestion des Restaurants</h2>";

    if ($restaurants) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nom</th><th>Actions</th></tr>";

        foreach ($restaurants as $restaurant) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($restaurant['id_resto']) . "</td>";
            echo "<td>" . htmlspecialchars($restaurant['nom_resto']) . "</td>";
            
            // Formulaire de modification du nom
            echo "<td>
                <form method='post' style='display:inline;'>
                    <input type='hidden' name='edit_restaurant_id' value='" . htmlspecialchars($restaurant['id_resto']) . "'>
                    <input type='text' name='new_name' placeholder='Nouveau nom' required>
                    <button type='submit'>Modifier</button>
                </form>
                ";

            // Formulaire de suppression du restaurant
            echo "
                <form method='post' style='display:inline;'>
                    <input type='hidden' name='delete_restaurant_id' value='" . htmlspecialchars($restaurant['id_resto']) . "'>
                    <button type='submit' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce restaurant ?\")'>Supprimer</button>
                </form>
            </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Aucun restaurant trouvé.</p>";
    }
} catch (PDOException $e) {
    echo "<p>Erreur lors de la récupération des restaurants : " . $e->getMessage() . "</p>";
}

include 'footer.php';
?>
