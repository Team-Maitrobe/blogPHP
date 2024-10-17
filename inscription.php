<?php
?>

<?php include 'header.php'; ?>

        <main>
            <h1>Bienvenue sur le blog</h1>
            <p>Veuillez procéder à votre inscription</p>

            <div class="boite-bleue">
                <form method="POST">
                    <label for="email">Saisir votre adresse-email :</label>
                    <input type="email" id="email" name="email" min="1" max = "60" required />

                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" min="1" max = "25" required />

                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" min="1" max = "25" required />

                    <label for="username">Pseudo :</label>
                    <input type="text" id="pseudo" name="pseudo" min="3" max = "15" required />

                    <label for="mdp">Veuillez choisir un mot de passe :</label>
                    <input type="text" id="motDePasse" name="motDePasse" min="1" max = "25" required />

                    <input type="submit" value="S'inscrire">

                    <p>Déjà inscrit ?</p>
                    <a href="./connexion.php">Connectez vous ici</a>
                </form>
                
                <p>Retournez à l'accueil en cliquant ici : 
                    <a href="./index.php">ACCUEIL</a>
                </p>
            </div>
        </main>
        <footer>
            <p>© 2024 BlogPHP. Tous droits réservés.</p>
        </footer>
    </body>
</html>
