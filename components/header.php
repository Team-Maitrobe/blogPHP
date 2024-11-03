<?php
session_start();
include 'connexionbd.php'; // Assurez-vous que la connexion est bien établie

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogPHP</title>
    <link href="../style.css" rel="stylesheet">
    <style>
        header {
            display: flex;
            background-color: #457B9D;
            justify-content: space-between;
            align-items: center;
            flex-direction: row;
            margin: 0px;
        }
        img {
            height: 75px;
            width: 75px;
        }
        #rechercheResto {
            height: 35px;
            width: 350px;
            vertical-align: baseline;
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <header>
        <a href="../index.php">
            <img src="../img/Fou2food.png" alt="logo de Fou2food, une fourchette et un couteau">
        </a>
        <?php include 'recherche.php'; ?>

        <?php
        if (isset($pdo)) { // Vérifie si la connexion à la base de données est établie
            if (!empty($_SESSION['user'])) {
                // Récupérer le pseudo depuis la base de données en utilisant l'email stocké dans la session
                $email = $_SESSION['user'];
                $sql = 'SELECT pseudo FROM FOUFOOD.UTILISATEUR WHERE email = :email';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['email' => $email]);
                $pseudo = $stmt->fetchColumn();

                if ($pseudo) {
                    echo "<p>Connecté en tant que " . htmlspecialchars($pseudo) . "</p>";
                } else {
                    echo "<p>Connecté en tant que utilisateur</p>";
                }
                
            } else {
                echo "<p>Vous n'êtes pas connecté.</p>";
            }
            
        } else {
            echo "<p>Erreur de connexion à la base de données.</p>";
        }
        ?>

        <a href="<?php echo !empty($_SESSION['user']) ? '../pages/profil.php' : '../pages/connexion.php'; ?>">
            <img src="../img/user.png" alt="image type d'une photo de profil"/>
        </a>
    </header>
</body>
</html>
