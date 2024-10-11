CREATE DATABASE FOUFOOD;

CREATE TABLE FOUFOOD.UTILISATEUR (
    PSEUDO VARCHAR2(15) NOT NULL,
    PRENOM VARCHAR2(25) NOT NULL,
    NOMDEFAMILLE VARCHAR(25) NOT NULL,
    MOTDEPASSE VARCHAR(25) NOT NULL,
    EMAIL VARCHAR(60) NOT NULL?
    PRIMARY KEY (PSEUDO)
)

CREATE TABLE FOUFOOD.RESTAURANT (
    ID INT(3) NOT NULL AUTO_INCREMENT,
    NOM VARCHAR2(100) NOT NULL,
    ADRESSE VARCHAR2(100) NOT NULL,
    
)