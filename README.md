# Gestion-TM
Outil de gestion pour le jeu Transport-Manager (jeu sur navigateur)

## Comment utiliser cet outil ?
### Prérequis
• Un serveur web
• Une base de données SQL

### Installation
1. Placer les fichiers à la racine de votre serveur ou dans un dossier dedié dans le cas d'un serveur où se trouve déjà des pages web

2. Créer une table SQL nommée "Véhicules" avec les colonnes suivantes:
   
• ID (Type INT)

• Modele (Type TEXT)

• Carburant (Type TEXT)

• Places (Type INT)

• KM (Type INT)

• EtatTechnique (Type INT)

• EtatMoteur (Type INT)

• MES (Type DATE)

• Garantie (Type DATE)

• CT (Type DATE)

• Revision (Type DATE)

• Argus (Type INT)

• Statut (Type TEXT)

3. Insérer les données de vos véhicules dans la table SQL

4. Définir la colonne ID en tant que clé primaire

5. Créer une 2ème table SQL nommée "Pannes avec les colonnes suivantes:
   
• IDVehicule (Type INT)

• Date (Type DATE)

• TypePanne (Type TEXT)

• MontantPanne (Type INT)

• PriseEnCharge (Type TEXT)

6. Définir la colonne IDVehicule en tant que clé primaire

7. À chaque immobilisation d'un véhicule dans TM, reporter les informations dans la table SQL

## Limitations et bugs connus
### Limitations
• Aucune mise à jour automatique (TM ne met pas d'API à disposition pour faire ça)

• L'historique des pannes n'est pas encore fonctionnel dans cette version

### Bugs
• Ne pas mettre d'accents dans les données SQL sinon le tableau ne s'affichera pas sur la page SQL

• Les élements du menu en haut de page s'affiche en bleu comme des liens hypertextes classiques, rendant la lisibilité compliquée

• Si la colonne ID de la table Vehicules ou IDVehicule de la table Pannes n'est pas définie comme clé primaire alors la colonne ID du tableau affichera null sur toutes les lignes

## Historique des versions
### Version 1.0 (02/03/2025)
• Première version publique

• Affichage de la liste des véhicules: Fonctionnel

• Affichage de l'historique des pannes: Fonctionnel
