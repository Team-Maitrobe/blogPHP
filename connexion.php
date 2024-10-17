<?php
?>

<?php include 'header.php'; ?>

        <main>
            <h1>Bienvenue sur le blog</h1>
            <p>blog.exe a arrêté de fonctionner</p>

            <div class="boite-bleue">
                <form method="POST">
                    <label for="pseudo">Saisir votre pseudo ou adresse email :</label>
                    <input type="text" id="pseudo" name="pseudo" required />

                    <label for="mdp">Saisir votre mot de passe :</label>
                    <input type="password" id="mdp" name="mdp" required />

                    <input type="submit" value="Connexion">

                    <p>Pas encore inscrit ? <a href="./inscription.php">Rejoignez-nous ici</a></p>
                </form>
                
                <p>Retournez à l'accueil en cliquant ici : 
                    <a href="./blog.php">ACCUEIL</a>
                </p>
            </div>
        </main>
        <footer>
            footer
            <p>© 2024 BlogPHP. Tous droits réservés.</p>
        </footer>
    </body>
</html>
