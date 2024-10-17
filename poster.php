<?php
?>

<?php include 'header.php'; ?>

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