# Gestion-TM
Outil de gestion auto-hébergé pour le jeu Transport-Manager (jeu sur navigateur)

## Comment utiliser cet outil ?
### Prérequis
• Un serveur web

• Une base de données SQL

### Installation
1. Placer les fichiers à la racine de votre serveur ou dans un dossier dedié dans le cas d'un serveur où se trouve déjà des pages web

2. Entrer les identifiants de connexion à la base SQL dans le fichier config.php
   
3. Ouvrir le fichier install.php à l'aide de votre navigateur

4. Connectez vous à l'aide du mot de passe par défaut (azerty)

5. Vous êtes prets à ajouter vos véhicules

6. RECOMMANDÉ: Changez le mot de passe en allant dans les paramètres, en particulier si cet outil est accessible en dehors de votre réseau local

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

• Les élements du menu en haut de page s'affiche en bleu comme des liens hypertextes classiques lorsqu'ils n'ont pas été cliqués, rendant la lisibilité compliquée

## Historique des versions
### Version 1.2 (29/07/2025)
• Les créneaux nocturnes sont désormais intégrés aux affectation (lignes PL1, PL2 et PL3)

• Un script d’installation est disponible pour créer automatiquement les tables SQL (install.php)

• Les mises à jour sont vérifiées automatiquement par l'outil

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
