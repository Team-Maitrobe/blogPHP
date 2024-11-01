CREATE DATABASE FOUFOOD;

CREATE TABLE FOUFOOD.UTILISATEUR (
    pseudo VARCHAR(15) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,

    PRIMARY KEY (pseudo)
);

CREATE TABLE FOUFOOD.RESTAURANT (
    id_resto INT NOT NULL AUTO_INCREMENT,
    nom_resto VARCHAR(100) NOT NULL,
    adresse_resto VARCHAR(100) NOT NULL,
    type_commande INT,
    services_proposes INT,
    regimes_proposes INT,
    type_cuisine VARCHAR(20) NOT NULL,
    ambiance VARCHAR(20),
    tranche_prix VARCHAR(5) NOT NULL,

    PRIMARY KEY (id_resto)
);

CREATE TABLE FOUFOOD.POST (
    id_post INT NOT NULL AUTO_INCREMENT,
    date_post DATETIME NOT NULL,
    titre_post VARCHAR(70) NOT NULL,
    type_post VARCHAR(9) NOT NULL,
    contenu_post VARCHAR(280) NOT NULL,
    id_resto INT NOT NULL,
    id_post_parent INT,
    pseudo_bloggeur VARCHAR(15) NOT NULL,

    PRIMARY KEY (id_post),

    FOREIGN KEY (id_resto) REFERENCES FOUFOOD.RESTAURANT(id_resto),
    FOREIGN KEY (id_post_parent) REFERENCES FOUFOOD.POST(id_post)
        ON DELETE CASCADE, -- Ça efface le post si le post parent est effacé
    FOREIGN KEY (pseudo_bloggeur) REFERENCES FOUFOOD.UTILISATEUR(pseudo)
);
