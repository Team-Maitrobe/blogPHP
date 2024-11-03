<?php 
session_start();
include '../components/header.php'; 
include '../components/connexionbd.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    echo "<p>Vous devez être connecté pour accéder à cette page.</p>";
    include 'footer.php'; 
    exit;
}

try {
    // Récupère le pseudo de l'utilisateur connecté
    $pseudo = $_SESSION['user'];

    // Vérifie dans la base de données si l'utilisateur est administrateur
    $sql = 'SELECT admin FROM FOUFOOD.UTILISATEUR WHERE pseudo = :pseudo';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['pseudo' => $pseudo]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result || $result['admin'] != 1) {
        echo "<p>Vous n'avez pas les droits nécessaires pour accéder à cette page.</p>";
        include 'footer.php'; 
        exit;
    }

    // Traitement des modifications et suppressions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['delete_id'])) {
            $deleteId = $_POST['delete_id'];
            $sqlDelete = 'DELETE FROM FOUFOOD.RESTAURANT WHERE id_resto = :id';
            $stmtDelete = $pdo->prepare($sqlDelete);
            $stmtDelete->execute(['id' => $deleteId]);
            echo "<p>Restaurant supprimé avec succès.</p>";
        } elseif (isset($_POST['update_id_name'], $_POST['new_name'])) {
            $updateId = $_POST['update_id_name'];
            $newName = $_POST['new_name'];
            $sqlUpdate = 'UPDATE FOUFOOD.RESTAURANT SET nom_resto = :new_name WHERE id_resto = :id';
            $stmtUpdate = $pdo->prepare($sqlUpdate);
            $stmtUpdate->execute(['new_name' => $newName, 'id' => $updateId]);
            echo "<p>Nom du restaurant mis à jour avec succès.</p>";
        } elseif (isset($_POST['update_id_address'], $_POST['new_address'])) {
            $updateId = $_POST['update_id_address'];
            $newAddress = $_POST['new_address'];
            $sqlUpdate = 'UPDATE FOUFOOD.RESTAURANT SET adresse_resto = :new_address WHERE id_resto = :id';
            $stmtUpdate = $pdo->prepare($sqlUpdate);
            $stmtUpdate->execute(['new_address' => $newAddress, 'id' => $updateId]);
            echo "<p>Adresse du restaurant mise à jour avec succès.</p>";
        }
    }

    // Affichage de la liste des restaurants
    $sqlRestaurants = 'SELECT * FROM FOUFOOD.RESTAURANT';
    $stmtRestaurants = $pdo->query($sqlRestaurants);
    $restaurants = $stmtRestaurants->fetchAll(PDO::FETCH_ASSOC);

    echo "<h1>Gestion des restaurants</h1>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>";

    foreach ($restaurants as $restaurant) {
        echo "<tr>
                <td>" . htmlspecialchars($restaurant['id_resto']) . "</td>
                <td>" . htmlspecialchars($restaurant['nom_resto']) . "</td>
                <td>" . htmlspecialchars($restaurant['adresse_resto']) . "</td>
                <td>
                    <form method='POST' style='display:inline;'>
                        <input type='hidden' name='delete_id' value='" . htmlspecialchars($restaurant['id_resto']) . "'>
                        <button type='submit' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce restaurant ?')\">Supprimer</button>
                    </form>
                    <form method='POST' style='display:inline;'>
                        <input type='hidden' name='update_id_name' value='" . htmlspecialchars($restaurant['id_resto']) . "'>
                        <input type='text' name='new_name' placeholder='Nouveau nom' required>
                        <button type='submit'>Modifier</button>
                    </form>
                    <form method='POST' style='display:inline;'>
                        <input type='hidden' name='update_id_address' value='" . htmlspecialchars($restaurant['id_resto']) . "'>
                        <input type='text' name='new_address' placeholder='Nouvelle addresse' required>
                        <button type='submit'>Modifier</button>
                    </form>
                </td>
            </tr>";
    }
    echo "</table>";

} catch (PDOException $e) {
    echo "<p>Erreur SQL : " . $e->getMessage() . "</p>";
}

include 'footer.php'; 
?>
