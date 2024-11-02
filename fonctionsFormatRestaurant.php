<?php 

// Fonction pour formater les types de commandes
function formatTypeCommande($typeCommande) {
    $types = [];

    // Vérification des types de commande
    if ($typeCommande & 1) $types[] = 'Livraison à domicile'; // 1
    if ($typeCommande & 2) $types[] = 'Sur place';            // 2
    if ($typeCommande & 4) $types[] = 'À emporter';           // 4
    if ($typeCommande & 8) $types[] = 'Too Good To Go';       // 8

    return !empty($types) ? implode(', ', $types) : 'Aucune option de commande sélectionnée';
}

//Fonction pour formater les régimes proposés
function formatRegimesProposes($regimesProposes) {
    $regimes = [];

    //Vérification des régimes proposés
    if ($regimesProposes & 1) $regimes[] = 'Végétarien'; //1
    if ($regimesProposes & 2) $regimes[] = 'Vegan'; //2
    if ($regimesProposes & 4) $regimes[] = 'Menu enfant'; //4
    if ($regimesProposes & 8) $regimes[] = 'Hallal'; //8
    if ($regimesProposes & 16) $regimes[] = 'Kasher'; //16
    if ($regimesProposes & 32) $regimes[] = 'Poisson'; //32

    return !empty($regimes) ? implode(', ', $regimes) : 'Le restaurant ne propose pas de régimes particuliers';
}

//Fonction pour formater les différents services proposés
function formatServicesProposes($servicesProposes) {
    $services = [];

    //Vérification des services proposés
    if ($servicesProposes & 1) $services[] = 'Petit déjeuner'; //1
    if ($servicesProposes & 2) $services[] = 'Déjeuner'; //2
    if ($servicesProposes & 4) $services[] = 'Dîner'; //4

    return !empty($services) ? implode(', ', $services) : 'Aucune horaire particulière pour ce restaurant';
}


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
            return 'Moins de 10€ par personne';
        case 'm20':
            return 'Entre 10 et 20€ par personne';
        case 'm30':
            return 'Entre 20 et 30€ par personne';
        case 'm40':
            return 'Entre 30 et 40€ par personne';
        case 'm50':
            return 'Entre 40 et 50€ par personne';
        case 'p50':
            return 'Plus de 50€ par personne';
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

?>