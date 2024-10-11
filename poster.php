<?php
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BlogPHP</title>
    </head>
    <body>
        <header>
            header
        </header>
        <main>
            <h1>/**Nom du restaurant**/</h1>
        <div class="boite-bleue">          
            <form method="POST">
                <input type="text" name="titre" placeholder="Titre" />
                
                <input type="radio" name="typecomentaire" value="avis"/>
                <label for="avis">Avis</label>

                <input type="radio" name="typecomentaire" value="question"/>
                <label for="question">Question</label>

                <input type="text" name="commentaire" placeholder="Ecrire ici" />

                <input type="submit">
            </form>
        </div>
        </main>
        <footer>
            footer
        </footer>
    </body>
</html>