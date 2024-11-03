<?php
include '../components/header.php'; 
include '../components/connexionbd.php';

$emailExist = false; // Variable pour vérifier si l'email est utilisé

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];
    $pseudo = $_POST['pseudo'] ?? ''; // Récupère le pseudo s'il a été rempli

    // Vérifier si l'email existe déjà dans la base de données
    $sql_select = 'SELECT mot_de_passe FROM FOUFOOD.UTILISATEUR WHERE email = :email';
    $stmt = $pdo->prepare($sql_select);
    $stmt->execute(['email' => $email]);
    $hashedPassword = $stmt->fetchColumn();

    if ($hashedPassword === false) {
        // L'email n'existe pas, l'utilisateur peut choisir un pseudo
        $emailExist = false;

        // Si le pseudo est renseigné, procéder à l'inscription
        if (!empty($pseudo)) {
            // Hash du mot de passe
            $hashedPassword = password_hash($motDePasse, PASSWORD_DEFAULT);

            // Insertion du nouvel utilisateur
            $sql_insert = 'INSERT INTO FOUFOOD.UTILISATEUR (email, mot_de_passe, pseudo) VALUES (:email, :mot_de_passe, :pseudo)';
            $stmt = $pdo->prepare($sql_insert);
            $stmt->execute([
                'email' => $email,
                'mot_de_passe' => $hashedPassword,
                'pseudo' => $pseudo
            ]);

            // Démarrer la session pour l'utilisateur
            $_SESSION['user'] = $email;
            header('Location: ../index.php'); // Redirection vers la page d'accueil
            exit;
        }
    } else {
        // L'email existe, vérifier le mot de passe
        if (password_verify($motDePasse, $hashedPassword)) {
            // Mot de passe correct, démarrer la session
            $_SESSION['user'] = $email; // Stocker l'email dans la session
            header('Location: ../index.php'); // Redirection vers la page d'accueil
            exit;
        } else {
            // Mot de passe incorrect
            echo "<p style='color: red;'>Mauvais mot de passe</p>";
        }
    }
}
?>

<main>
    <h1>Bienvenue sur le blog</h1>
    <p>Veuillez vous connecter</p>

    <div class="boite-bleue-connexion">
        <form method="POST">
            <label for="email">Email :</label>
            <input type="text" id="email" name="email" maxlength="128" required value="<?= htmlspecialchars($email ?? '') ?>" />

            <label for="motDePasse">Mot de passe :</label>
            <input type="password" id="motDePasse" name="motDePasse" maxlength="25" required value="<?= htmlspecialchars($motDePasse ?? '') ?>" />

            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $hashedPassword === false): ?>
                <!-- Champ pour le pseudo qui apparaît si l'email n'existe pas -->
                <?php include '../components/choisirPseudo.php'; ?>
            <?php endif; ?>

            <input type="submit" value="Se connecter">
        </form>

        <p>Retournez à l'accueil en cliquant ici : 
            <a href="../index.php">ACCUEIL</a>
        </p>
    </div>
</main>

<?php include '../components/footer.php'; ?>
