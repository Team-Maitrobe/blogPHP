<?php
include 'connexionbd.php';

$sql_select = 'SELECT id_resto, nom_resto, adresse_resto, type_commande, services_proposes, regimes_proposes, type_cuisine, ambiance, tranche_prix FROM FOUFOOD.RESTAURANT';
$stmt = $pdo->prepare($sql_select);
$stmt->execute();
$restaurants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>

<main>
    <h1>Liste des restaurants</h1>
    <div class="boite-bleue">
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
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
                            
                                <td><?= htmlspecialchars($restaurant['id_resto']) ?></td>
                                <td><a href="./restaurant?restaurant=<?= htmlspecialchars($restaurant['id_resto']) ?>"><?= htmlspecialchars($restaurant['nom_resto']) ?></a></td>
                                <td><?= htmlspecialchars($restaurant['adresse_resto']) ?></td>
                                <td><?= htmlspecialchars($restaurant['type_commande']) ?></td>
                                <td><?= htmlspecialchars($restaurant['services_proposes']) ?></td>
                                <td><?= htmlspecialchars($restaurant['regimes_proposes']) ?></td>
                                <td><?= htmlspecialchars($restaurant['type_cuisine']) ?></td>
                                <td><?= htmlspecialchars($restaurant['ambiance']) ?></td>
                                <td><?= htmlspecialchars($restaurant['tranche_prix']) ?></td>
                            
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
