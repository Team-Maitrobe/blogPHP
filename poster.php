<?php
if(!empty($_POST['submit'])) {
    $titre = $_GET['titre'];
    $typecommentaire = $_GET['typecommentaire'];
    $commentaire = $_GET['commentaire'];

    $sql = 'INSERT INTO POST(titre_post, type_post, contenu_post) 
            VALUES(:titre, :typecommentaire, :contenu_post)';

    $stmt = $pdo->prepare($sql);
    $stmt->execute(["titre" => $titre, "typecommentaire" => $typecommentaire, "commentaire" => $commentaire]);}


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
        <footer>
            footer
        </footer>
    </body>
</html>