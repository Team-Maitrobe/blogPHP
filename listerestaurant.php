<?php
    include 'connexionbd.php';

    // Préparer la requête SQL de base
    $sql_select = 'SELECT id_resto, nom_resto, adresse_resto, type_commande, services_proposes, regimes_proposes, type_cuisine, ambiance, tranche_prix FROM FOUFOOD.RESTAURANT';

    // Vérifie si une recherche a été faite
    if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
        $searchTerm = '%' . trim($_GET['search']) . '%'; // Ajoute des jokers pour la recherche
        $sql_select .= ' WHERE nom_resto LIKE :search'; // Ajoute une condition de recherche

        $stmt = $pdo->prepare($sql_select);
        $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR); // Lie le paramètre
    } else {
        $stmt = $pdo->prepare($sql_select); // Prépare la requête sans condition de recherche
    }

    $stmt->execute(); // Exécute la requête
    $restaurants = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupère les résultats

include 'header.php'; 

include 'fonctionsFormatRestaurant.php';

?>


<main>
    <h1>Liste des restaurants</h1>
    <a href="./ajouter.php">Ajouter un restaurant</a>
    <div class="boite-bleue-liste">
        <table border="1">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>Type de commande</th>
                    <th>Services proposés</th>
                    <th>Régimes proposés</th>
                    <th>Type de cuisine</th>
                    <th>Ambiance</th>
                    <th>Tranche de prix</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($restaurants) > 0): ?>
                    <?php foreach ($restaurants as $restaurant): ?>
                        <tr>
                                <td><a href="./restaurant.php?restaurant=<?= htmlspecialchars($restaurant['id_resto']) ?>"><?= htmlspecialchars($restaurant['nom_resto']) ?></a></td>
                                <td><?= htmlspecialchars($restaurant['adresse_resto']) ?></td>
                                <td><?= formatTypeCommande($restaurant['type_commande']) ?></td>
                                <td><?= formatServicesProposes($restaurant['services_proposes']) ?></td>
                                <td><?= formatRegimesProposes($restaurant['regimes_proposes']) ?></td>
                                <td><?= formatTypeCuisine($restaurant['type_cuisine']) ?></td>
                                <td><?= formatAmbiance($restaurant['ambiance']) ?></td>
                                <td><?= formatTranchePrix($restaurant['tranche_prix']) ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="9">Aucun restaurant trouvé</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include 'footer.php'; ?>
