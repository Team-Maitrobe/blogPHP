<?php
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BlogPHP</title>
    </head>
    <body>
        <header>

            <input type="text" name="nomDuRestaurant" placeholder="Rechercher"/>
        </header>
        <main>
            <h1>/**Ajouter un restaurant**/</h1>
        <div class="boite-bleue">          
            <form method="POST">

                <input type="text" name="nomDuRestaurant" placeholder="Nom du restaurant"/>
                <input type="text" name="adresse" placeholder="Adresse"/>

                <div class="commentManger">
                    <label class="livraisonADomicile">
                        <input type="checkbox" name="answer" />
                        Livraison a domicile
                    </label>
                    <label class="surPlace">
                        <input type="checkbox" name="answer" />
                        Sur place
                    </label>
                    <label class="aEmporter">
                        <input type="checkbox" name="answer" />
                        A emporter
                    </label>
                    <label class="toGoodToGo">
                        <input type="checkbox" name="answer" />
                        TooGoodToGo
                    </label>
                </div>

                <div class="typeDeCuisine">
                    <select name="typeDeCuisine" id="typeCuisine">
                    <option value="">--Type de cuisine--</option>
                    <option value="americaine">Americaine</option>
                    <option value="asiatique">Asiatique</option>
                    <option value="chinoise">Chinoise</option>
                    <option value="creperie">Creperie</option>
                    <option value="francais">Française</option>
                    <option value="fastfood">FastFood</option>
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
                    <select name="ambiance" id="ambiance">
                    <option value="ambiance">--Ambiance--</option>
                    <option value="romantique">Romantique</option>
                    <option value="familiale">Familiale</option>
                    <option value="moderneEtElegante">Moderne et élégante</option>
                    <option value="rustique ">Rustique </option>
                    <option value="festive">Festive</option>
                    <option value="decontractee ">décontractée </option>
                    <option value="chicEtBranchee">Chic et branchée</option>
                    <option value="thematique ">Thématique </option>
                    </select>
                </div>

                <div class="prix">
                    <select name="prix" id="prix">
                    <option value="prix">--Tranche de prix--</option>
                    <option value="zeroDix">0-10</option>
                    <option value="dixVingt">10-20</option>
                    <option value="vingtTrente">20-30</option>
                    <option value="trenteQuarante ">30-40 </option>
                    <option value="quaranteCinquante">40-50</option>
                    <option value="tropChere">trop chere zebi</option>
                    </select>
                </div>

                <div class="typeDeCuisine">
                    <label class="vegetarien">
                        <input type="checkbox" name="answer" />
                        Végétarien
                    </label>
                    <label class="vegan">
                        <input type="checkbox" name="answer" />
                        Végan
                    </label>
                    <label class="menuEnfant">
                        <input type="checkbox" name="answer" />
                        Menu Enfant
                    </label>
                    <label class="halal">
                        <input type="checkbox" name="answer" />
                        Halal
                    </label>
                    <label class="kasher">
                        <input type="checkbox" name="answer" />
                        Kasher
                    </label>
                    <label class="poisson">
                        <input type="checkbox" name="answer" />
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
            </form>
        </div>
        </main>
        <footer>
            footer
        </footer>
    </body>
</html>