<?php
include 'header.php';
include 'connexionbd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $nom = $_POST['nomDuRestaurant'];
    $adresse = $_POST['adresse'];
    $typeCuisine = $_POST['typeDeCuisine'];
    $tranchePrix = $_POST['prix'];
    $ambiance = $_POST['ambiance'];

    // Initialisation des valeurs bitwise
    $typeCommande = 0;
    $servicesProposes = 0;
    $regimesProposes = 0;

    // Type de commande
    if (isset($_POST['livraisonADomicile'])) $typeCommande |= 1;
    if (isset($_POST['surPlace'])) $typeCommande |= 2;
    if (isset($_POST['aEmporter'])) $typeCommande |= 4;
    if (isset($_POST['tooGoodToGo'])) $servicesProposes |= 1;

    // Régimes alimentaires
    if (isset($_POST['vegetarien'])) $regimesProposes |= 1;
    if (isset($_POST['vegan'])) $regimesProposes |= 2;
    if (isset($_POST['menuEnfant'])) $regimesProposes |= 4;
    if (isset($_POST['halal'])) $regimesProposes |= 8;
    if (isset($_POST['kasher'])) $regimesProposes |= 16;
    if (isset($_POST['poisson'])) $regimesProposes |= 32;

    try {
        // Préparation et exécution de l'insertion en base de données
        $sql = 'INSERT INTO FOUFOOD.RESTAURANT (nom_resto, adresse_resto, type_commande, services_proposes, regimes_proposes, type_cuisine, ambiance, tranche_prix)
                VALUES (:nom, :adresse, :typeCommande, :servicesProposes, :regimesProposes, :typeCuisine, :ambiance, :tranchePrix)';
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nom' => $nom,
            'adresse' => $adresse,
            'typeCommande' => $typeCommande,
            'servicesProposes' => $servicesProposes,
            'regimesProposes' => $regimesProposes,
            'typeCuisine' => $typeCuisine,
            'ambiance' => $ambiance,
            'tranchePrix' => $tranchePrix
        ]);

        echo "Restaurant ajouté avec succès!";
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout du restaurant : " . $e->getMessage();
    }
}
?>

<main>
    <h1>Ajouter un restaurant</h1>
    <div class="boite-bleue">
        <form method="POST">
            <input type="text" name="nomDuRestaurant" placeholder="Nom du restaurant" required />
            <input type="text" name="adresse" placeholder="Adresse" required />

            <div class="options">
                <label><input type="checkbox" name="livraisonADomicile" /> Livraison à domicile</label>
                <label><input type="checkbox" name="surPlace" /> Sur place</label>
                <label><input type="checkbox" name="aEmporter" /> À emporter</label>
                <label><input type="checkbox" name="tooGoodToGo" /> Too Good To Go</label>
            </div>


            <div class="typeDeCuisine">
                <select name="typeDeCuisine" id="typeCuisine" required>
                    <option value="">--Type de cuisine--</option>
                    <option value="americaine">Américaine</option>
                    <option value="asiatique">Asiatique</option>
                    <option value="chinoise">Chinoise</option>
                    <option value="creperie">Crêperie</option>
                    <option value="francaise">Française</option>
                    <option value="fastfood">Fast Food</option>
                    <option value="indienne">Indienne</option>
                    <option value="italienne">Italienne</option>
                    <option value="japonaise">Japonaise</option>
                    <option value="marocaine">Marocaine</option>
                    <option value="pizza">Pizza</option>
                    <option value="brasserie">Brasserie</option>
                    <option value="thai">Thaï</option>
                    <option value="vietnamienne">Vietnamienne</option>
                </select>
            </div>

            <div class="ambiance">
                <select name="ambiance" id="ambiance" required>
                    <option value="">--Ambiance--</option>
                    <option value="romantique">Romantique</option>
                    <option value="familiale">Familiale</option>
                    <option value="moderneEtElegante">Moderne et élégante</option>
                    <option value="rustique">Rustique</option>
                    <option value="festive">Festive</option>
                    <option value="decontractee">Décontractée</option>
                    <option value="chicEtBranchee">Chic et branchée</option>
                    <option value="thematique">Thématique</option>
                </select>
            </div>

            <div class="prix">
                <select name="prix" id="prix" required>
                    <option value="">--Tranche de prix--</option>
                    <option value="m10">0-10</option>
                    <option value="m20">10-20</option>
                    <option value="m30">20-30</option>
                    <option value="m40">30-40</option>
                    <option value="m50">40-50</option>
                    <option value="p50">50+</option>
                </select>
            </div>

            <div class="restrictionAlimentaire">
                <label for="vegetarien">
                    <input type="checkbox" id="vegetarien" name="vegetarien"/>
                    Végétarien
                </label>
                <label for="vegan">
                    <input type="checkbox" id="vegan" name="vegan"/>
                    Végan
                </label>
                <label for="menuEnfant">
                    <input type="checkbox" id="menuEnfant" name="menuEnfant"/>
                    Menu Enfant
                </label>
                <label for="halal">
                    <input type="checkbox" id="halal" name="halal"/>
                    Halal
                </label>
                <label for="kasher">
                    <input type="checkbox" id="kasher" name="kasher"/>
                    Kasher
                </label>
                <label for="poisson">
                    <input type="checkbox" id="poisson" name="poisson"/>
                    Poisson
                </label>
            </div>
            <div class="typeDeCuisine">
            <label class="petitDejeuner">
                <input type="checkbox" name="answer" />
                Petit Déjeuner
            </label>
            <label class="dejeuner">
                <input type="checkbox" name="answer" />
                Déjeuner
            </label>
            <label class="diner">
                <input type="checkbox" name="answer" />
                Diner
            </label>
        </div>
        <input type="submit" value="Ajouter"/>
    </form>
</div>
</main>

<?php include 'footer.php'; ?>
