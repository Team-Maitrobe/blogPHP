<?php 
include '../components/header.php'; 
include '../components/connexionbd.php'; // Assurez-vous que la connexion est correcte
?>

<main>
    
    <?php
    include '../components/fonctionsFormatRestaurant.php';
    
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
                echo '<div class="boite-bleu-restaurant">';
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
                echo '</div>';
                   

                // Suppression du commentaire et de ses réponses
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer_commentaire'], $_POST['id_commentaire'])) {
                    $idCommentaire = $_POST['id_commentaire'];
                    $pseudo = $_SESSION['user'];

                    try {
                        // Vérifie que l'utilisateur est le propriétaire du commentaire
                        $stmtVerif = $pdo->prepare('SELECT pseudo_bloggeur FROM FOUFOOD.POST WHERE id_post = :idCommentaire');
                        $stmtVerif->execute(['idCommentaire' => $idCommentaire]);
                        $comment = $stmtVerif->fetch(PDO::FETCH_ASSOC);

                        if ($comment && $comment['pseudo_bloggeur'] === $pseudo) {
                            // Supprime d'abord toutes les réponses associées
                            $stmtDeleteReplies = $pdo->prepare('DELETE FROM FOUFOOD.POST WHERE id_post_parent = :idCommentaire');
                            $stmtDeleteReplies->execute(['idCommentaire' => $idCommentaire]);

                            // Supprime ensuite le commentaire parent
                            $stmtDeleteComment = $pdo->prepare('DELETE FROM FOUFOOD.POST WHERE id_post = :idCommentaire');
                            $stmtDeleteComment->execute(['idCommentaire' => $idCommentaire]);

                            echo "<p>Commentaire supprimé avec succès.</p>";
                        } else {
                            echo "<p>Vous n'êtes pas autorisé à supprimer ce commentaire.</p>";
                        }
                    } catch (PDOException $e) {
                        echo "<p>Erreur lors de la suppression du commentaire : " . $e->getMessage() . "</p>";
                    }
                }

                // Suppression d'une réponse spécifique
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer_reponse'], $_POST['id_reponse'])) {
                    $idReponse = $_POST['id_reponse'];
                    $pseudo = $_SESSION['user'];

                    try {
                        // Vérifie que l'utilisateur est le propriétaire de la réponse
                        $stmtVerifReponse = $pdo->prepare('SELECT pseudo_bloggeur FROM FOUFOOD.POST WHERE id_post = :idReponse');
                        $stmtVerifReponse->execute(['idReponse' => $idReponse]);
                        $reponse = $stmtVerifReponse->fetch(PDO::FETCH_ASSOC);

                        if ($reponse && $reponse['pseudo_bloggeur'] === $pseudo) {
                            // Supprime uniquement la réponse
                            $stmtDeleteReponse = $pdo->prepare('DELETE FROM FOUFOOD.POST WHERE id_post = :idReponse');
                            $stmtDeleteReponse->execute(['idReponse' => $idReponse]);

                            echo "<p>Réponse supprimée avec succès.</p>";
                        } else {
                            echo "<p>Vous n'êtes pas autorisé à supprimer cette réponse.</p>";
                        }
                    } catch (PDOException $e) {
                        echo "<p>Erreur lors de la suppression de la réponse : " . $e->getMessage() . "</p>";
                    }
                }

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
                        echo "<h3>" . htmlspecialchars($commentaire['titre_post']) . "</h3>";
                        echo "<p>" . nl2br(htmlspecialchars($commentaire['contenu_post'])) . "</p>";
                        
                        // Bouton "Répondre"
                        echo '
                            <form action="poster.php" method="get" style="display:inline;">
                                <input type="hidden" name="restaurant" value="' . htmlspecialchars($idresto) . '">
                                <input type="hidden" name="id_post_parent" value="' . htmlspecialchars($commentaire['id_post']) . '">
                                <button type="submit" class="btn-repondre">Répondre</button>
                            </form>';

                        // Bouton de suppression si l'utilisateur est le propriétaire du commentaire
                        if ($commentaire['pseudo_bloggeur'] === $_SESSION['user']) {
                            echo '
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="id_commentaire" value="' . htmlspecialchars($commentaire['id_post']) . '">
                                    <button type="submit" name="supprimer_commentaire" class="btn-supprimer">Supprimer</button>
                                </form>';
                        }

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

                                // Bouton de suppression si l'utilisateur est le propriétaire de la réponse
                                if ($reponse['pseudo_bloggeur'] === $_SESSION['user']) {
                                    echo '
                                        <form method="post" style="display:inline;">
                                            <input type="hidden" name="id_reponse" value="' . htmlspecialchars($reponse['id_post']) . '">
                                            <button type="submit" name="supprimer_reponse" class="btn-supprimer">Supprimer</button>
                                        </form>';
                                }
                                echo "</div>";
                            }
                            echo "</div>";
                        }
                
                        echo "</div>";
                    }
                } else {
                    echo "<p>Aucun commentaire pour ce restaurant.</p>";
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

<?php include '../components/footer.php'; ?>
