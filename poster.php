<?php

if(!empty($_POST['submit'])){
// Connexion à la base de données (envisagez de stocker les identifiants dans un fichier de configuration ou des variables d'environnement)
$servername = "localhost";
$username = "root";
$password = "2917";
$dbname = "FOUFOOD";

$titre = $_POST['titre'];
$typecommentaire = $_POST['typecommentaire'];
$commentaire = $_POST['commentaire'];

if(!empty($titre) && !empty($typecommentaire) && !empty($commentaire)) {
    $sql = 'INSERT INTO POST(titre_post, type_post, contenu_post) 
    VALUES(:titre, :typecommentaire, :commentaire)';
} else {
    echo "Veuillez remplir tous les champs.";
}

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
    "titre" => $titre, 
    "typecommentaire" => $typecommentaire, 
    "commentaire" => $commentaire
]);

if ($stmt) {
    header("Location: index.php"); //A MODIFIER POUR REDIRIGER SUR LE POST 
}

}


?>

<?php include 'header.php'; ?>

        <main>
            <h1>/**Nom du restaurant**/</h1>
        <div class="boite-bleue">          
            <form method="POST">
                <input type="text" name="titre" placeholder="Titre" required/>
                
                <input type="radio" name="typecommentaire" value="avis"/>
                <label for="avis">Avis</label>

                <input type="radio" name="typecommentaire" value="question"/>
                <label for="question">Question</label>

                <input type="text" name="commentaire" placeholder="Ecrire ici" required/>

                <input type="submit">
            </form>
        </div>
        </main>
<?php include 'footer.php'; ?>
