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

• TypeVehicule (Type TEXT) - À partir de la version 1.0.2-beta2

• Categorie (Type TEXT) - À partir de la version 1.0.2-beta2

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

5. Créer une 2ème table SQL nommée "Pannes" avec les colonnes suivantes:
   
• IDVehicule (Type INT)

• Date (Type DATE)

• TypePanne (Type TEXT)

• MontantPanne (Type INT)

• PriseEnCharge (Type TEXT)

6. Définir la colonne IDVehicule en tant que clé primaire

7. À chaque immobilisation d'un véhicule dans TM, reporter les informations dans la table SQL et reporter les données de vos véhicules via la page Ajouter un véhicule ou via PhpMyAdmin

8. Créer une 3ème table SQL nommée "Affectations" avec les colonnes suivantes de type INT:
• ID (clé primaire)
• HC
• HP
• HS
• HSaC
• HSaP
• HSaS
• HDC
• HDP
Les colonnes ci-dessus correspondent aux créneaux horaires de TM
Les ID de vos véhicules doivent correspondre aux ID de la table Vehicules pour permettre la récupération automatique du modèle du véhicule

## Mise à jour

1. Télecharger la dernière version

2. Vérifier les notes de mises à jour en cas de modification dans la structure des fichiers ou de la base SQL

3. Si demandé dans les notes de mise à jour, appliquer les éventuelles modifications dans la structure des fichiers

4. Remplacer tous les fichiers de l'ancienne version (sauf config.php) par ceux de la nouvelle version

5. Si demandé dans les notes de mise à jour, appliquer les éventuelles modifications dans la base SQL


## Limitations et bugs connus
### Limitations
• Aucune mise à jour automatique (TM ne met pas d'API à disposition pour faire ça)

### Bugs
• Ne pas mettre d'accents dans les données SQL sinon le tableau ne s'affichera pas sur la page SQL

• Les élements du menu en haut de page s'affiche en bleu comme des liens hypertextes classiques, rendant la lisibilité compliquée

• Si la colonne ID de la table Vehicules ou IDVehicule de la table Pannes n'est pas définie comme clé primaire alors la colonne ID du tableau affichera null sur toutes les lignes

## Historique des versions
### Version 1.1 (22/03/2025)
• Il est maintenant possible de visualiser et modifier les affectations de ses véhicules
### Version 1.0.2 (03/03/2025)
• Il est maintenant d’ajouter un véhicule via l’outil de gestion

• Il est maintenant possible de déclarer une panne dans l’outil de gestion

• Affichage des pannes les plus récentes en 1er

• Affichage des véhicules par ordre croissant de numérotation

• Le type de véhicule et la catégorie figurent maintenant dans la liste des véhicules

• Lisibilité améliorée: les éléments du menu s’affichent maintenant en blanc

### Version 1.0.1 (02/03/2025)
• Ajout des couleurs pour les colonnes Carburant, État Technique, État Intérieur, CT, Révision et Statut:
   - Les colonnes Carburant, État Technique et État Intérieur utilisent les couleurs de TM
   - Pour les CT, en Rouge si le CT est dépassé, en Jaune si le CT expire dans moins d'un mois, sinon en Vert
   - Pour les Révisions, en Rouge si pas de révision ou si plus de 6 mois, en Jaune si la révision entre 5 et 6 mois, sinon en Vert
   - Pour le Statut, en Vert si en service, en Jaune si au dépot, en Rouge si le véhicule est à l'atelier, en Gris si le véhicule est en attente de commande
### Version 1.0 (02/03/2025)
• Première version publique

• Affichage de la liste des véhicules: Fonctionnel

• Affichage de l'historique des pannes: Fonctionnel
