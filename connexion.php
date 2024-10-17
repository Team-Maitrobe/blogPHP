<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = trim($_POST['pseudo']);
    $mdp = $_POST['mdp'];

    // Connexion à la base de données (envisagez de stocker les identifiants dans un fichier de configuration ou des variables d'environnement)
    $servername = "localhost";
    $username = "root";
    $password = "supermaitro";
    $dbname = "FOUFOOD";

    try {
        // Connexion PDO sécurisée
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifiez si l'utilisateur existe par pseudo ou email
        $stmt = $conn->prepare("SELECT * FROM FOUFOOD.UTILISATEUR WHERE pseudo = :pseudo OR courriel = :pseudo");
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && ($mdp == $user['mot_de_passe'])) {
            // Démarrez la session de manière sécurisée et régénérez l'ID de session pour éviter les attaques de fixation
            session_start();
            session_regenerate_id(true); // Important pour la sécurité de la session

            // Stockez les informations de l'utilisateur dans la session
            $_SESSION['user_id'] = $user['pseudo']; // Vous n'avez pas de colonne id, donc utilisation du pseudo
            $_SESSION['pseudo'] = $user['pseudo'];

            // Redirigez vers la page d'accueil après une connexion réussie
            header("Location: index.php");
            exit();
        } else {
            $error = "Pseudo/email ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        // Enregistrez l'exception au lieu d'afficher l'erreur en production
        error_log("Échec de la connexion : " . $e->getMessage());
        $error = "Une erreur s'est produite lors de la connexion à la base de données.";
    }
}
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

            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error); ?></p> 
            <?php endif; ?>

            <p>Pas encore inscrit ? <a href="./inscription.php">Rejoignez-nous ici</a></p>
        </form>
        
        <p>Retournez à l'accueil en cliquant ici : 
            <a href="./index.php">ACCUEIL</a>
        </p>
    </div>
</main>

<?php include 'footer.php'; ?>
