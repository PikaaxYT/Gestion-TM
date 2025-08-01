<?php
session_start();

if (!isset($_SESSION['niveau'])) {
    header("Location: login.html");
    exit;
}
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="styles.css" rel="stylesheet">
    <link href="fonts.css" rel="stylesheet">
    <title>Ajouter un véhicule - Outil de gestion TM (par Pikaax)</title>
    <style>
        /* Style pour le tableau */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #0000bb;
            color: #ffffff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        
    </style>
</head>
<body>
    <div class="header outfit-regular">
        <center><h1>Outil de gestion TM</h1></center>
    </div>
    <div class="header-menu outfit-regular">
        <center>        
            <a href="accueil.php" class="header-menu-elt">Accueil</a>
            <a href="affectations.php" class="header-menu-elt">Affectations</a>
            <a href="vehicules.php" class="header-menu-elt">Véhicules</a>
            <a href="ajout-vehicule.php" class="header-menu-elt active">Ajouter un véhicule</a>
            <a href="pannes.php" class="header-menu-elt">Historique des pannes</a>
            <a href="declaration-panne.php" class="header-menu-elt">Déclarer une panne</a>
            <a href="parametres.php" class="header-menu-elt">Paramètres</a>
        </center>
    </div>
    <br>
    <div class="outfit-regular">
    <div class="formulaire">
    <center>
        <h1>Ajouter un véhicule</h1>
        <p>*Ce champ est obligatoire</p>
     </center>
           <form action="ajout_vehicule.php" method="POST">
    
        <label for="type_vehicule">Type de Véhicule*:</label>
    <select name="type_vehicule" id="type_vehicule" required>
        <option value="Minibus">Minibus</option>
        <option value="Midibus">Midibus</option>
        <option value="Standard">Standard</option>
        <option value="Articule">Articulé</option>
        <option value="StandardBHNS">Standard BHNS</option>
        <option value="ArticuleBHNS">Articulé BHNS</option>
        <option value="StandardLE">Standard LE</option>
        <option value="ArticuleLE">Articulé LE</option>
        <option value="Autocar">Autocar</option>
    </select></br>
    
        <label for="categorie" required>Catégorie :</label>
    <select name="categorie" id="categorie">
        <option value="Vehicule en Service Commercial">Véhicule en Service Commercial</option>
        <option value="ParcMusee">Parc Musée</option>
        <option value="Reserve">Réserve</option>
    </select><br/>
        
        <label for="modele">Modèle*:</label>
        <input type="text" id="modele" name="modele" required><br/>

        <label for="carburant">Carburant*:</label>
        <select id="carburant" name="carburant" required>
            <option value="Diesel">Diesel</option>
            <option value="Hybride">Hybride</option>
            <option value="Electrique">Électrique</option>
            <option value="GNV">GNV</option>
        </select><br/>

        <label for="places">Nombre de places:</label>
        <input type="number" id="places" name="places"><br/>

        <label for="km">Kilométrage:</label>
        <input type="number" id="km" name="km"><br/>

        <label for="etat_technique">État Technique:</label>
        <input type="number" id="etat_technique" name="etat_technique"><br/>

        <label for="etat_interieur">État Intérieur:</label>
        <input type="number" id="etat_interieur" name="etat_interieur"><br/>
        
        <label for="mes">Mise en service:</label>
        <input type="date" id="mes" name="mes"><br/>
        
        <label for="garantie">Fin de garantie:</label>
        <input type="date" id="garantie" name="garantie"><br/>

        <label for="ct">Date du CT:</label>
        <input type="date" id="ct" name="ct"><br/>
        
        <label for="revision">Date de la dernière révision:</label>
        <input type="date" id="revision" name="revision"><br/>
        
        <label for="argus">Argus:</label>
        <input type="number" id="argus" name="argus"><br/>

        <label for="statut">Statut:</label>
        <select id="statut" name="statut" required>
            <option value="En service">En service</option>
            <option value="Au dépôt">Au dépôt</option>
            <option value="Atelier">Atelier</option>
            <option value="En attente de commande">En attente de commande</option>
        </select><br/>

        <button type="submit">Ajouter</button>
    </form>
    </div>
</body>
</html>
