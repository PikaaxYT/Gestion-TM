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
    <title>Historique des Pannes - Outil de gestion TM (par Pikaax)</title>
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
            <a href="ajout-vehicule.php" class="header-menu-elt">Ajouter un véhicule</a>
            <a href="pannes.php" class="header-menu-elt active">Historique des pannes</a>
            <a href="declaration-panne.php" class="header-menu-elt">Déclarer une panne</a>
            <a href="parametres.php" class="header-menu-elt">Paramètres</a>
        </center>
    </div>
    <div class="outfit-regular">
        <h1>Historique des Pannes</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Type de Panne</th>
                    <th>Montant</th>
                    <th>Prise en charge</th>
                </tr>
            </thead>
            <tbody id="pannes"></tbody>
        </table>
    </div>
    <script>
        // Récupération des données
        fetch("get_data2.php")
        .then(response => response.json())
        .then(data => {
            let tbody = document.getElementById("pannes");
            data.forEach(vehicule => {
                let row = `<tr>
                    <td>${vehicule.IDVehicule}</td>            <!-- Correspond à la clé 'IDVehicule' dans le PHP -->
                    <td>${vehicule.Date}</td>       <!-- Correspond à la clé 'Date' dans le PHP -->
                    <td>${vehicule.TypePanne}</td>          <!-- Correspond à la clé 'TypePanne' dans le PHP -->
                    <td>${vehicule.MontantPanne}</td>          <!-- Correspond à la clé 'MontantPanne' dans le PHP -->
                    <td>${vehicule.PriseEnCharge}</td>          <!-- Correspond à la clé 'PriseEnCharge' dans le PHP -->
                </tr>`;
                tbody.innerHTML += row;
            });
        })
        .catch(error => console.error("Erreur : " + error));
    </script>
</body>
</html>
