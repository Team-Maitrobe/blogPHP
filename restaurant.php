<?php 
include 'header.php'; 
include 'connexionbd.php'; // Assurez-vous que la connexion est correcte
?>

<main>
    <?php
    include 'fonctionsFormatRestaurant.php';

    // Vérifie si les paramètres 'restaurant' existent dans l'URL
    if (isset($_GET['restaurant'])) {
        $idresto = $_GET['restaurant'];

        try {
            // Prépare et exécute la requête pour récupérer toutes les informations du restaurant
            $sql = 'SELECT * FROM FOUFOOD.RESTAURANT WHERE id_resto = :idresto';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['idresto' => $idresto]);
            
            // Récupère toutes les informations du restaurant
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Affichage des informations avec formatage
                echo "<h1>Restaurant : " . htmlspecialchars($result['nom_resto']) . "</h1>";
                echo "<h4>Adresse : " . htmlspecialchars($result['adresse_resto']) . "</h4>";
                echo "<p>Type de cuisine : " . formatTypeCuisine($result['type_cuisine']) . "</p>"; 
                echo "<p>Ambiance : " . formatAmbiance($result['ambiance']) . "</p>"; 
                echo "<p>Tranche de prix : " . formatTranchePrix($result['tranche_prix']) . "</p>"; 
                echo "<p>Type de commande : " . formatTypeCommande($result['type_commande']) . "</p>"; 
                echo "<p>Services proposés : " . formatServicesProposes($result['services_proposes']) . "</p>"; 
                echo "<p>Régimes proposés : " . formatRegimesProposes($result['regimes_proposes']) . "</p>"; 

                // Formulaire pour ajouter un commentaire
                echo '
                    <form action="poster.php" method="get" style="display:inline;">
                        <input type="hidden" name="restaurant" value="' . htmlspecialchars($idresto) . '">
                        <button type="submit" class="btn">Ajouter un commentaire</button>
                    </form>';

                // Récupérer et afficher les commentaires
                $sqlCommentaires = 'SELECT * FROM FOUFOOD.POST WHERE id_resto = :idresto AND id_post_parent IS NULL ORDER BY date_post DESC';
                $stmtCommentaires = $pdo->prepare($sqlCommentaires);
                $stmtCommentaires->execute(['idresto' => $idresto]);
                $commentaires = $stmtCommentaires->fetchAll(PDO::FETCH_ASSOC);

                echo "<h2>Commentaires :</h2>";
                if ($commentaires) {
                    foreach ($commentaires as $commentaire) {
                        echo "<div class='commentaire'>";
                        // Affichage du titre
                        echo "<strong>" . htmlspecialchars($commentaire['pseudo_bloggeur']) . "</strong> <em>(" . htmlspecialchars($commentaire['date_post']) . ")</em>";
                        echo "<h3>" . htmlspecialchars($commentaire['titre_post']) . "</h3>"; // Ajoute cette ligne pour le titre
                        echo "<p>" . nl2br(htmlspecialchars($commentaire['contenu_post'])) . "</p>";
                        
                        // Bouton "Répondre"
                        echo '
                            <form action="poster.php" method="get" style="display:inline;">
                                <input type="hidden" name="restaurant" value="' . htmlspecialchars($idresto) . '">
                                <input type="hidden" name="id_post_parent" value="' . htmlspecialchars($commentaire['id_post']) . '">
                                <button type="submit" class="btn-repondre">Répondre</button>
                            </form>';
                        
                        // Récupérer les réponses à ce commentaire
                        $sqlReponses = 'SELECT * FROM FOUFOOD.POST WHERE id_post_parent = :id_post_parent ORDER BY date_post ASC';
                        $stmtReponses = $pdo->prepare($sqlReponses);
                        $stmtReponses->execute(['id_post_parent' => $commentaire['id_post']]);
                        $reponses = $stmtReponses->fetchAll(PDO::FETCH_ASSOC);
                
                        // Affichage des réponses
                        if ($reponses) {
                            echo "<div style='margin-left: 20px;'>";
                            foreach ($reponses as $reponse) {
                                echo "<div class='reponse'>";
                                echo "<strong>" . htmlspecialchars($reponse['pseudo_bloggeur']) . " répond à " . htmlspecialchars($commentaire['pseudo_bloggeur']) . "</strong> <em>(" . htmlspecialchars($reponse['date_post']) . ")</em>";
                                echo "<p>" . nl2br(htmlspecialchars($reponse['contenu_post'])) . "</p>";
                                echo "</div>";
                            }
                            echo "</div>";
                        }
                
                        echo "</div>";
                    }
                } else {
                    echo "<p>Aucun commentaire n'a été posté pour ce restaurant.</p>";
                }
                
            } else {
                echo "<p>Restaurant non trouvé.</p>";
            }
        } catch (PDOException $e) {
            echo "<p>Erreur SQL : " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>Paramètres d'URL manquants.</p>";
    }
    ?>
</main>

<?php include 'footer.php'; ?>
