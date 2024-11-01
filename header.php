<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BlogPHP</title>
        <style>
            header{
                display: flex;
                background-color: #457B9D;
                justify-content: space-between;
                align-items: center;
                flex-direction: row;
                margin: 0px;
            }
            img{
                height: 75px;
                width: 75px;
            }
            #rechercheResto{
                height: 35px;
                width: 350px;
                vertical-align: baseline;
                border-radius: 12px;
            }
        </style>
    </head>
    <body>
        <header>
            <a href="./index.php">
                <img src="./img/Fou2food.png" alt="logo de Fou2food, une fourchette et un couteau">
            </a>
            <input id="rechercheResto" type="text" name="nomDuRestaurant" placeholder="Rechercher un restaurant"/>
            <?php if (!empty($_SESSION['user'])): ?>
                <a href="./profil.php">
            <?php else : ?>
                <a href="./inscription.php">
            <?php endif; ?>
                    <img src="./img/user.png" alt="image type d'une photo de profil"/>
                </a>
            
        </header>
