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
    <link rel="icon" href="data:,">
    <title>Liste des véhicules - Outil de gestion TM (par Pikaax)</title>
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
            padding: 6px;
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
            <a href="accueil.php" class="header-menu-elt active">Accueil</a>
            <a href="affectations.php" class="header-menu-elt active">Affectations</a>
            <a href="vehicules.php" class="header-menu-elt">Véhicules</a>
            <a href="ajout-vehicule.php" class="header-menu-elt">Ajouter un véhicule</a>
            <a href="pannes.php" class="header-menu-elt">Historique des pannes</a>
            <a href="declaration-panne.php" class="header-menu-elt">Déclarer une panne</a>
            <a href="parametres.php" class="header-menu-elt">Paramètres</a>
        </center>
    </div>
    <div class="outfit-regular">
        <h1>Liste des Véhicules</h1>
        <p>Les modifications sont sauvegardées automatiquement</p>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Modèle</th>
                    <th>Type de Véhicule</th>
                    <th>Catégorie</th>
                    <th>Carburant</th>
                    <th>Places</th>
                    <th>KM</th>
                    <th>État Moteur</th>
                    <th>État Intérieur</th>
                    <th>M.E.S</th>
                    <th>Garantie</th>
                    <th>CT</th>
                    <th>Révision</th>
                    <th>Argus</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody id="vehicules"></tbody>
        </table>
    </div>
    <script>
     // Fonction pour calculer la couleur de la colonne Carburant
    function getCarbColor(Carb) {
        if (Carb === "Diesel") {
            return "background-color: #FFEE44;";
        } else if (Carb === "Hybride") {
            return "background-color: #88AAFF;";
        } else if (Carb === "GNV") {
            return "background-color: #66DD66;";
        } else if (Carb === "Electrique") {
            return "background-color: #FFFF33;";
        }
        return "";
    }
    
    // Fonction pour calculer la couleur de la colonne CT en fonction de la date
    function getCTColor(ctDate) {
        if (ctDate === "0000-00-00") {
            return ""; // Pas de couleur pour les dates invalides
        }

        let today = new Date(); // Date du jour
        let ct = new Date(ctDate); // Conversion de la date du CT
        let oneMonthLater = new Date();
        oneMonthLater.setMonth(oneMonthLater.getMonth() + 1); // Date + 1 mois
        
        if (isNaN(ct.getTime())) {
            return ""; // Vérification supplémentaire pour éviter les erreurs avec un format invalide
        }

        if (ct < today) {
            return "background-color: #FF8888;";
        } else if (ct >= today && ct <= oneMonthLater) {
            return "background-color: #FFFF88;";
        } else {
            return "background-color: #88FF88;";
        }
    }
    
    // Fonction pour calculer la couleur de la colonne Revision en fonction de la date
    function getRevColor(revDate) {

        let today = new Date(); // Date du jour
        let rev = new Date(revDate); // Conversion de la date de revision
        let sixMonthsPrior = new Date();
        sixMonthsPrior.setMonth(sixMonthsPrior.getMonth() - 6); // Date - 6 mois
        let fiveMonthsPrior = new Date();
        fiveMonthsPrior.setMonth(fiveMonthsPrior.getMonth() - 5); // Date - 5 mois
        
        if (isNaN(rev.getTime())) {
            return "background-color: #FF8888;";
        }

        if (rev < sixMonthsPrior) {
            return "background-color: #FF8888;";
        } else if (rev >= sixMonthsPrior && rev <= fiveMonthsPrior) {
            return "background-color: #FFFF88;";
        } else {
            return "background-color: #88FF88;";
        }
    }
    
    // Fonction pour la couleur du statut
    function getStatutColor(statut) {
        if (statut === "En service") {
            return "background-color: #88FF88;";
        } else if (statut === "Au depot") {
            return "background-color: #FFFF88;";
        } else if (statut.includes("Atelier")) {
            return "background-color: #FF8888;";
        } else if (statut === "En attente de commande") {
            return "background-color: #888888; color: #FFFFFF;";
        }
        return "";
    }
    
   
function activerModification() {
  document.querySelectorAll('input[name]').forEach(input => {
    input.addEventListener('change', function () {
      const id = this.dataset.id;
      const champ = this.name; 
      const value = this.value;

      fetch('update_vehicules.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${encodeURIComponent(id)}&champ=${encodeURIComponent(champ)}&valeur=${encodeURIComponent(value)}`
      })
      .then(res => {
        if (!res.ok) throw new Error('HTTP error ' + res.status);
        return res.text();
      })
      .then(data => {
        console.log('Réponse du serveur:', data);
      })
      .catch(error => {
        console.error("Erreur lors du fetch :", error);
      });
    });
  });
}

    
    // Récupération des données depuis get_data.php
    fetch("get_data.php")
    .then(response => response.json())
    .then(data => {
        let tbody = document.getElementById("vehicules");
        data.forEach(vehicule => {
            let row = document.createElement("tr");

            let tdID = `<td>${vehicule.ID}</td> <!-- Correspond à la clé 'ID' du PHP -->`;
            let tdModele = `<td>${vehicule.Modele}</td> <!-- Correspond à la clé 'Modele' du PHP -->`;
            let tdTypeVehicule = `<td>${vehicule.TypeVehicule}</td> <!-- Correspond à la clé 'TypeVehicule' du PHP -->`;
            let tdCategorie = `<td>${vehicule.Categorie}</td> <!-- Correspond à la clé 'Categorie' du PHP -->`;
            
            // Modification de couleur pour le carburant
            let colorCarb = getCarbColor(vehicule.Carburant);
            let tdCarburant = `<td style="${colorCarb}">${vehicule.Carburant}</td> <!-- Correspond à la clé 'Carburant' du PHP -->`;
            
            let tdPlaces = `<td>${vehicule.Places}</td> <!-- Correspond à la clé 'Places' du PHP -->`;
            let tdKM = `<td><input type="text" class="input" name="KM" value="${vehicule.KM}" data-id="${vehicule.ID}"></td> <!-- Correspond à la clé 'KM' du PHP -->`;
            
            // Modification de couleur pour l'état technique
            let colorEtatTechnique = "";
            if (vehicule.EtatTechnique <= 40) {
                colorEtatTechnique = "background-color: #FF8888;";
            } else if (vehicule.EtatTechnique > 40 && vehicule.EtatTechnique <= 70) {
                colorEtatTechnique = "background-color: #FFFF88;";
            } else if (vehicule.EtatTechnique > 70) {
            	    colorEtatTechnique = "background-color: #88FF88;";
            }
            let tdEtatTechnique = `<td style="${colorEtatTechnique}"><input type="text" class="input" name="EtatTechnique" value="${vehicule.EtatTechnique}" data-id="${vehicule.ID}"></td> <!-- Correspond à la clé 'EtatTechnique' du PHP -->`;

            // Modification de couleur pour l'état intérieur
            let colorEtatInterieur = "";
            if (vehicule.EtatInterieur <= 40) {
                colorEtatInterieur = "background-color: #FF8888;";
            } else if (vehicule.EtatInterieur > 40 && vehicule.EtatInterieur <= 70) {
                colorEtatInterieur = "background-color: #FFFF88;";
            } else if (vehicule.EtatInterieur > 70) {
            	    colorEtatInterieur = "background-color: #88FF88;";
            }
            let tdEtatInterieur = `<td style="${colorEtatInterieur}"><input type="text" class="input" name="EtatInterieur" value="${vehicule.EtatInterieur}" data-id="${vehicule.ID}"></td> <!-- Correspond à la clé 'EtatInterieur' du PHP -->`;

            let tdMES = `<td>${vehicule.MES}</td> <!-- Correspond à la clé 'MES' du PHP -->`;
            let tdGarantie = `<td>${vehicule.Garantie}</td> <!-- Correspond à la clé 'Garantie' du PHP -->`;
            
            // Modification de couleur pour le CT
            let colorCT = getCTColor(vehicule.CT);
            let tdCT = `<td style="${colorCT}"><input type="text" class="input" name="CT" value="${vehicule.CT}" data-id="${vehicule.ID}"></td> <!-- Correspond à la clé 'CT' du PHP -->`;
            
            // Modification de couleur pour la Révision
            let colorRev = getRevColor(vehicule.Revision);
            let tdRevision = `<td style="${colorRev}"><input type="text" class="input" name="Revision" value="${vehicule.Revision}" data-id="${vehicule.ID}"></td> <!-- Correspond à la clé 'Revision' du PHP -->`;
            
            let tdArgus = `<td><input type="text" class="input" name="Argus" value="${vehicule.Argus}" data-id="${vehicule.ID}"></td> <!-- Correspond à la clé 'Argus' du PHP -->`;
            
            // Modification de couleur pour le statut
            let colorStatut = getStatutColor(vehicule.Statut);
            let tdStatut = `<td style="${colorStatut}">${vehicule.Statut}</td> <!-- Correspond à la clé 'Statut' du PHP -->`;

            row.innerHTML = tdID + tdModele + tdTypeVehicule + tdCategorie + tdCarburant + tdPlaces + tdKM + 
                            tdEtatTechnique + tdEtatInterieur + tdMES + tdGarantie + 
                            tdCT + tdRevision + tdArgus + tdStatut;

            tbody.appendChild(row);
        });
        activerModification();
    })
    


    .catch(error => console.error("Erreur : " + error));
	</script>
</body>
</html>
