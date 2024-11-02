<?php include 'header.php'; ?>

<main>
    <h1>Bienvenue sur le blog</h1>
    <p>Bienvenue sur FouFood, le blog interactif vous permettant de choisir un restaurant proche de vous, 
et qui conviendra à tout le monde !</p>

    <div class="boite-bleu-index">
        <a href="./connexion.php">Connexion</a>

        <?php if (!empty($_SESSION['user'])): ?>
            <a href='./ajouter.php'>Ajouter un restaurant</a>
        <?php endif ?>

        <a href="./listerestaurant.php">Liste des restaurants</a>
    </div>
    
</main>

<?php include 'footer.php'; ?>