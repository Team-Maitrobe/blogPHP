<?php
include 'connexionbd.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $pseudo = $_POST['pseudo'];
    $motDePasse = $_POST['motDePasse'];

    // Check if user exists and retrieve their hashed password
    $sql_select = 'SELECT mot_de_passe FROM FOUFOOD.UTILISATEUR WHERE pseudo = :pseudo';
    $stmt = $pdo->prepare($sql_select);
    $stmt->execute(['pseudo' => $pseudo]);
    $hashedPassword = $stmt->fetchColumn();

    if ($hashedPassword === false) {
        // User does not exist, so we create a new user
        $hashedPassword = password_hash($motDePasse, PASSWORD_DEFAULT);
        $sql_insert = 'INSERT INTO FOUFOOD.UTILISATEUR(pseudo, mot_de_passe) VALUES(:pseudo, :motDePasse)';
        $stmt_insert = $pdo->prepare($sql_insert);
        $stmt_insert->execute([
            'pseudo' => $pseudo,
            'motDePasse' => $hashedPassword,
        ]);

        echo "inscription réussie!";
    } else if (password_verify($motDePasse, $hashedPassword)) {
        // Password is correct
        $_SESSION['user'] = $pseudo;
        header('Location: index.php');
    } else {
        // Incorrect password
        echo "Mauvais mot de passe";
    }
}
?>

<main>
    <h1>Bienvenue sur le blog</h1>
    <p>Veuillez vous connecter</p>

    <div class="boite-bleue">
        <form method="POST">
            <label for="pseudo">Pseudo :</label>
            <input type="text" id="pseudo" name="pseudo" maxlength="15" required />

            <label for="motDePasse">Mot de passe :</label>
            <input type="password" id="motDePasse" name="motDePasse" maxlength="25" required />

            <input type="submit" value="S'inscrire">
        </form>

        <p>Retournez à l'accueil en cliquant ici : 
            <a href="./index.php">ACCUEIL</a>
        </p>
    </div>
</main>

<?php include 'footer.php'; ?>
