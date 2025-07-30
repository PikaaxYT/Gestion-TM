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
    <title>Déclaration de panne - Outil de gestion TM (par Pikaax)</title>
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
            <a href="vehicules.php" class="header-menu-elt">Véhicules</a>
            <a href="ajout-vehicule.php" class="header-menu-elt">Ajouter un véhicule</a>
            <a href="pannes.php" class="header-menu-elt">Historique des pannes</a>
            <a href="declaration-panne.php" class="header-menu-elt active">Déclarer une panne</a>
            <a href="parametres.php" class="header-menu-elt">Paramètres</a>
        </center>
    </div>
    <br>
    <div class="outfit-regular">
    <div class="formulaire">
    <center>
        <h1>Déclaration de panne</h1>
        <p>*Ce champ est obligatoire</p>
    </center>
           <form action="declaration_panne.php" method="POST">
        
        <label for="modele">ID du véhicule*:</label>
        <input type="number" id="id" name="id" required><br/>

        <label for="date">Date*:</label>
        <input type="date" id="date" name="date" required><br/>

        <label for="TypePanne">Type de panne*:</label>
        <input type="text" id="TypePanne" name="TypePanne" required><br/>

        <label for="MontantPanne">Montant de la panne*:</label>
        <input type="number" id="MontantPanne" name="MontantPanne" required><br/>

        <label for="PriseEnCharge">Prise en Charge:</label>
        <input type="text" id="PriseEnCharge" name="PriseEnCharge"><br/>

        <button type="submit">Valider</button>
    </form>
    </div>
</body>
</html>
