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
                margin: 0px;
            }
            img{
                width: 75px;
                height: 75px;
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
            <img src="./img/Fou2food.png" alt="logo de Fou2food, une fourchette et un couteau">
            <input id="rechercheResto" type="text" name="nomDuRestaurant" placeholder="Rechercher un restaurant"/>
            <img src="./img/user.png" alt="image type d'une photo de profil"/>
        </header>
