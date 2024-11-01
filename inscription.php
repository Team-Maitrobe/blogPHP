<?php
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Path to the JSON file
$jsonFilePath = './security/id.json';

// Check if the JSON file exists
if (!file_exists($jsonFilePath)) {
    die("JSON file not found at $jsonFilePath !");
}

// Parse the JSON file
$id = json_decode(file_get_contents($jsonFilePath), true);

// Check if the JSON decoding was successful and if the necessary keys exist
if ($id === null) {
    die('Failed to decode JSON. Error: ' . json_last_error_msg());
}

if (!isset($id['servername'], $id['username'], $id['password'], $id['dbname'])) {
    die('Missing required keys in id.json. Check that "servername", "username", "password", and "dbname" are present.');
}

// Construct the DSN (Data Source Name)
$dsn = "mysql:host={$id['servername']};dbname={$id['dbname']};charset=utf8";

try {
    // Create the PDO connection using the constructed DSN
    $pdo = new PDO($dsn, $id['username'], $id['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

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

        echo "Inscription réussie!";
    } else if (password_verify($motDePasse, $hashedPassword)) {
        // Password is correct
        $_SESSION['user'] = $pseudo;
        header('Location: index.php');
    } else {
        // Incorrect password
        echo "Mauvais mdp";
    }
}
?>

<?php include 'header.php'; ?>

<main>
    <h1>Bienvenue sur le blog</h1>
    <p>Veuillez vous inscrire</p>

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
