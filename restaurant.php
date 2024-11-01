<?php 
include 'header.php'; 
include 'connexionbd.php'; // Assurez-vous que la connexion est correcte
?>

<main>
    <?php
    // Fonction pour formater l'ambiance
    function formatAmbiance($ambiance) {
        switch ($ambiance) {
            case 'romantique':
                return 'Romantique';
            case 'familiale':
                return 'Familiale';
            case 'moderneEtElegante':
                return 'Moderne et élégante';
            case 'rustique':
                return 'Rustique';
            case 'festive':
                return 'Festive';
            case 'decontractee':
                return 'Décontractée';
            case 'chicEtBranchee':
                return 'Chic et branchée';
            case 'thematique':
                return 'Thématique';
            default:
                return htmlspecialchars($ambiance); // Au cas où une valeur inattendue est rencontrée
        }
    }

    // Fonction pour formater la tranche de prix
    function formatTranchePrix($tranchePrix) {
        switch ($tranchePrix) {
            case 'm10':
                return 'moins de 10€ par personne';
            case 'm20':
                return 'Entre 10 et 20€ par personne';
            case 'm30':
                return 'Entre 20 et 30€ par personne';
            case 'm40':
                return 'Entre 30 et 40€ par personne';
            case 'm50':
                return 'Entre 40 et 50€ par personne';
            case 'p50':
                return 'Plus de 50€ par personne';
            default:
                return htmlspecialchars($tranchePrix); // Au cas où une valeur inattendue est rencontrée
        }
    }

    // Fonction pour formater le type de cuisine
    function formatTypeCuisine($typeCuisine) {
        switch ($typeCuisine) {
            case 'americaine':
                return 'Américaine';
            case 'asiatique':
                return 'Asiatique';
            case 'chinoise':
                return 'Chinoise';
            case 'creperie':
                return 'Crêperie';
            case 'francaise':
                return 'Française';
            case 'fastfood':
                return 'Fast Food';
            case 'indienne':
                return 'Indienne';
            case 'italienne':
                return 'Italienne';
            case 'japonaise':
                return 'Japonaise';
            case 'marocaine':
                return 'Marocaine';
            case 'pizza':
                return 'Pizza';
            case 'brasserie':
                return 'Brasserie';
            case 'thai':
                return 'Thaï';
            case 'vietnamienne':
                return 'Vietnamienne';
            default:
                return htmlspecialchars($typeCuisine); // Au cas où une valeur inattendue est rencontrée
        }
    }

    // Vérifie si les paramètres 'restaurant' existent dans l'URL
    if (isset($_GET['restaurant'])) {
        $idresto = $_GET['restaurant'];

        try {
            // Prépare et exécute la requête pour récupérer toutes les informations du restaurant
            $sql = 'SELECT *
                    FROM FOUFOOD.RESTAURANT 
                    WHERE id_resto = :idresto';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['idresto' => $idresto]);
            
            // Récupère toutes les informations du restaurant
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Affichage des informations avec formatage pour type_cuisine, ambiance et tranche_prix
                echo "<h1>Restaurant : " . htmlspecialchars($result['nom_resto']) . "</h1>";
                echo "<h4>Adresse : " . htmlspecialchars($result['adresse_resto']) . "</h4>";
                echo "<p>Type de cuisine : " . formatTypeCuisine($result['type_cuisine']) . "</p>"; // Formaté
                echo "<p>Ambiance : " . formatAmbiance($result['ambiance']) . "</p>"; // Formaté
                echo "<p>Tranche de prix : " . formatTranchePrix($result['tranche_prix']) . "</p>"; // Formaté
                echo "<p>Type de commande : " . htmlspecialchars($result['type_commande']) . "</p>"; // Non formaté
                echo "<p>Services proposés : " . htmlspecialchars($result['services_proposes']) . "</p>"; // Non formaté
                echo "<p>Régimes proposés : " . htmlspecialchars($result['regimes_proposes']) . "</p>"; // Non formaté
            } else {
                echo "<p>Restaurant non trouvé.</p>";
            }
        } catch (PDOException $e) {
            echo "<p>Erreur SQL : " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>Paramètres d'URL manquants.</p>";
    }
    ?>
</main>

<?php include 'footer.php'; ?>
