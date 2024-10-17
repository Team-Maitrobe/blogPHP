<?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $pseudo = $_POST['pseudo'];
                    $mdp = $_POST['mdp'];

                    // Database connection
                    $servername = "localhost";
                    $username = "root";
                    $password = "supermaitro";
                    $dbname = "FOUFOOD";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Check if user exists
                        $stmt = $conn->prepare("SELECT * FROM FOUFOOD.UTILISATEUR WHERE pseudo = :pseudo OR courriel = :pseudo");
                        $stmt->bindParam(':pseudo', $pseudo);
                        $stmt->execute();

                        $user = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($user && password_verify($mdp, $user['password'])) {
                            // Start session and set user info
                            session_start();
                            $_SESSION['user_id'] = $user['id'];
                            $_SESSION['pseudo'] = $user['pseudo'];
                            header("Location: index.php");
                            exit();
                        } else {
                            $error = "Pseudo/email ou mot de passe incorrect.";
                        }
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
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
                        <p style="color: red;"><?php echo $error; ?></p>
                    <?php endif; ?>

                    <p>Pas encore inscrit ? <a href="./inscription.php">Rejoignez-nous ici</a></p>
                </form>
                
                <p>Retournez à l'accueil en cliquant ici : 
                    <a href="./index.php">ACCUEIL</a>
                </p>
            </div>
        </main>

<?php include 'footer.php'; ?>
