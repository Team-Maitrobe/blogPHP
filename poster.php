<?php 
session_start(); // Assurez-vous que la session est démarrée
include 'header.php'; 
include 'connexionbd.php';

// Définir le fuseau horaire sur Paris
date_default_timezone_set('Europe/Paris');

if (isset($_GET['restaurant'])) {
    $idresto = $_GET['restaurant'];
    $idPostParent = $_GET['id_post_parent'] ?? null; // Si c'est une réponse à un commentaire

    // Vérifiez si le pseudo de l'utilisateur est disponible dans la session
    $pseudo = $_SESSION['user'] ?? null; // Obtenez le pseudo de la session
    if (!$pseudo) {
        echo "<p>Vous devez être connecté pour poster un commentaire.</p>";
        include 'footer.php'; 
        exit; // Quitter la page si l'utilisateur n'est pas connecté
    }

    // Vérifie si le post parent existe, seulement si un ID de post parent est fourni
    if ($idPostParent) {
        $sqlCheckParent = 'SELECT COUNT(*) FROM FOUFOOD.POST WHERE id_post = :idPostParent';
        $stmtCheck = $pdo->prepare($sqlCheckParent);
        $stmtCheck->execute(['idPostParent' => $idPostParent]);
        $parentExists = $stmtCheck->fetchColumn();

        if (!$parentExists) {
            echo "<p>Le post parent n'existe pas.</p>";
            include 'footer.php'; 
            exit; // Quitter la page si le post parent n'existe pas
        }
    }

    // Vérifie si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['commentaire']) && !empty($_POST['titre'])) {
        $commentaire = $_POST['commentaire'];
        $titre = $_POST['titre'];
        
        // Utiliser DateTime pour obtenir la date actuelle à Paris
        $dateTime = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $datePost = $dateTime->format('Y-m-d H:i:s'); // Obtenir la date actuelle au format SQL

        try {
            // Prépare la requête d'insertion
            $sql = 'INSERT INTO FOUFOOD.POST (date_post, titre_post, type_post, contenu_post, id_resto, pseudo_bloggeur' 
                 . ($idPostParent ? ', id_post_parent' : '') . ')
                     VALUES (:datePost, :titre, "comment", :contenu, :idresto, :pseudo' 
                 . ($idPostParent ? ', :idPostParent' : '') . ')';
            $stmt = $pdo->prepare($sql);

            // Définition des paramètres
            $params = [
                'datePost' => $datePost,
                'titre' => $titre,
                'contenu' => $commentaire,
                'idresto' => $idresto,
                'pseudo' => $pseudo,
            ];
            if ($idPostParent) {
                $params['idPostParent'] = $idPostParent;
            }

            // Exécution de la requête
            $stmt->execute($params);

            // Message de confirmation et lien de retour
            echo "<p>Commentaire ajouté avec succès !</p>";
            echo '<a href="restaurant.php?restaurant=' . urlencode($idresto) . '">Retourner au restaurant</a>';
        } catch (PDOException $e) {
            echo "<p>Erreur SQL : " . $e->getMessage() . "</p>";
        }
    } else {
        // Affichage du formulaire de commentaire
        echo '<div class="post">';
        echo '
            <h3>' . ($idPostParent ? "Répondre au commentaire" : "Ajouter un commentaire") . ' pour le restaurant</h3>
            <form method="post">
                <label for="titre">Titre :</label>
                <input type="text" id="titre" name="titre" maxlength="70" required><br>
                <label for="commentaire">Commentaire :</label>
                <textarea id="commentaire" name="commentaire" rows="4" cols="50" maxlength="280" placeholder="Votre commentaire ici..." required></textarea><br>
                <button type="submit" class="btn">Poster le commentaire</button>
            </form>
            <a href="restaurant.php?restaurant=' . urlencode($idresto) . '">Annuler</a>
        ';
        echo '</div>';
    }
} else {
    echo "<p>Paramètre 'restaurant' manquant dans l'URL.</p>";
}

include 'footer.php'; 
