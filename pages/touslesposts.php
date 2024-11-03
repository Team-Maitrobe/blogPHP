<?php 

include '../components/header.php'; 
include '../components/connexionbd.php';

include '../components/recherchePseudo.php';

// Vérifier si un terme de recherche a été passé
$searchTerm = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';

// Récupérer et afficher les commentaires, en filtrant par le terme de recherche si fourni
$sqlCommentaires = 'SELECT p.*, r.nom_resto FROM FOUFOOD.POST p
                    LEFT JOIN FOUFOOD.RESTAURANT r ON p.id_resto = r.id_resto
                    WHERE p.id_post_parent IS NULL';
if ($searchTerm) {
    $sqlCommentaires .= ' AND p.pseudo_bloggeur LIKE :searchTerm';
}
$sqlCommentaires .= ' ORDER BY p.date_post DESC';

$stmtCommentaires = $pdo->prepare($sqlCommentaires);

if ($searchTerm) {
    $stmtCommentaires->bindValue(':searchTerm', '%' . $searchTerm . '%'); // Utiliser LIKE pour une recherche partielle
}

$stmtCommentaires->execute();
$commentaires = $stmtCommentaires->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Commentaires :</h2>";
if ($commentaires) {
    foreach ($commentaires as $commentaire) {
        echo "<div class='commentaire'>";
        // Affichage du pseudo et du nom du restaurant
        echo "<strong>" . htmlspecialchars($commentaire['pseudo_bloggeur']) . "</strong> à propos de " . htmlspecialchars($commentaire['nom_resto']) . " <em>(" . htmlspecialchars($commentaire['date_post']) . ")</em>";
        echo "<h3>" . htmlspecialchars($commentaire['titre_post']) . "</h3>";
        echo "<p>" . nl2br(htmlspecialchars($commentaire['contenu_post'])) . "</p>";
        
        // Bouton "Répondre"
        echo '
            <form action="poster.php" method="get" style="display:inline;">
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
    echo "<p>Aucun commentaires à afficher.</p>";
}

include '../components/footer.php';

?>
