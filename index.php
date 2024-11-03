<?php include './components/header.php'; ?>
<?php include './components/connexionbd.php'; ?>

<?php
// Vérifiez si id.json existe
$idFilePath = './id.json';
$securityIdFilePath = './security.id.json';

// Si id.json n'existe pas, essayer de charger security.id.json
if (!file_exists($idFilePath) && file_exists($securityIdFilePath)) {
    // Copie de security.id.json vers id.json
    copy($securityIdFilePath, $idFilePath);
}

// Vous pouvez maintenant utiliser id.json en toute sécurité
// Assurez-vous d'ajouter votre code pour traiter le fichier id.json ici
?>

<main>
    <h1>Bienvenue sur le blog</h1>
    <p>Bienvenue sur FouFood, le blog interactif vous permettant de choisir un restaurant proche de vous, 
et qui conviendra à tout le monde !</p>

    <div class="boite-bleu-index">
        <a href="./pages/connexion.php">Connexion</a>

        <?php if (!empty($_SESSION['user'])): ?>
            <a href='./pages/ajouter.php'>Ajouter un restaurant</a>
        <?php endif ?>

        <a href="./pages/listerestaurant.php">Liste des restaurants</a>

        <a href="./pages/touslesposts.php">Tous les posts</a>
    </div>

</main>

<?php include './components/footer.php'; ?>
