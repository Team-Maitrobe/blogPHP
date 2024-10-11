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
            header
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
                </div>

                <div class="ambiance">
                    <select name="" id="ambiance">
                    <option value="ambiance">--Ambiance--</option>
                    <option value="romantique">Romantique</option>
                    <option value="familiale">Familiale</option>
                    <option value="chi">Moderne et élégante</option>
                    <option value="parrot">Creperie</option>
                    <option value="spider">Française</option>
                    <option value="goldfish">FastFood</option>
                    <option value="dog">Indienne</option>
                    <option value="cat">Italienne</option>
                    <option value="hamster">Japonaise</option>
                    <option value="parrot">Marocaine</option>
                    <option value="spider">Pizza</option>
                    <option value="goldfish">Brasserie</option>
                    <option value="spider">Thaï</option>
                    <option value="goldfish">Vietnamienne</option>
                </div>
            </form>
        </div>
        </main>
        <footer>
            footer
        </footer>
    </body>
</html>