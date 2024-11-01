<?php 
    include 'header.php'; 
    session_start();
?>

<main>
    <h1>Ajouter un restaurant</h1>
    <div class="boite-bleue">
        <form method="POST">
            <input type="text" name="nomDuRestaurant" placeholder="Nom du restaurant" required/>
            <input type="text" name="adresse" placeholder="Adresse" required/>

            <div class="options">
                <label for="livraisonADomicile">
                    <input type="checkbox" id="livraisonADomicile" name="livraisonADomicile"/>
                    Livraison à domicile
                </label>
                <label for="surPlace">
                    <input type="checkbox" id="surPlace" name="surPlace"/>
                    Sur place
                </label>
                <label for="aEmporter">
                    <input type="checkbox" id="aEmporter" name="aEmporter"/>
                    À emporter
                </label>
                <label for="tooGoodToGo">
                    <input type="checkbox" id="tooGoodToGo" name="tooGoodToGo"/>
                    Too Good To Go
                </label>
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
                    <option value="zeroDix">0-10</option>
                    <option value="dixVingt">10-20</option>
                    <option value="vingtTrente">20-30</option>
                    <option value="trenteQuarante">30-40</option>
                    <option value="quaranteCinquante">40-50</option>
                    <option value="cinquantePlus">50+</option>
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
