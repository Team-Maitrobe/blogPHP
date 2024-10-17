CREATE DATABASE FOUFOOD;

CREATE TABLE FOUFOOD.UTILISATEUR (
    pseudo VARCHAR2(15) NOT NULL,
    prenom VARCHAR2(25) NOT NULL,
    nom_de_famille VARCHAR(25) NOT NULL,
    mot_de_passe VARCHAR(25) NOT NULL,
    courriel VARCHAR(60) NOT NULL,

    PRIMARY KEY (pseudo)
)

CREATE TABLE FOUFOOD.RESTAURANT (
    id_resto INT(3) NOT NULL AUTO_INCREMENT,
    nom_resto VARCHAR2(100) NOT NULL,
    adresse_resto VARCHAR2(100) NOT NULL,
    type_commande INT(3)
    services_proposes INT(2),
    regimes_proposes INT(2),
    type_cuisine VARCHAR2(20) NOT NULL,
    ambiance INT(3),
    tranche_prix VARCHAR2(5) NOT NULL,

    PRIMARY KEY (id_resto)
)

CREATE TABLE FOUFOOD.POST (
    id_post INT(5) NOT NULL AUTO_INCREMENT,
    date_post DATETIME NOT NULL,
    titre_post VARCHAR2(70) NOT NULL,
    type_post VARCHAR2(9) NOT NULL,
    contenu_post VARCHAR2(280) NOT NULL,
    id_resto INT(3) NOT NULL,
    id_post_parent INT(5),
    pseudo_bloggeur VARCHAR2(15) NOT NULL,

    PRIMARY KEY (id_post),

    FOREIGN KEY (id_resto) REFERENCES FOUFOOD.RESTAURANT(id_resto),
    FOREIGN KEY (id_post_parent) REFERENCES FOUFOOD.POST(id_post)
)