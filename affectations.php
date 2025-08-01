<?php
session_start();

if (!isset($_SESSION['niveau'])) {
    header("Location: login.html");
    exit;
} else {
	$niveau = $_SESSION['niveau'];
}
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="styles.css" rel="stylesheet">
    <link href="fonts.css" rel="stylesheet">
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
            <a href="accueil.php" class="header-menu-elt">Accueil</a>
            <a href="affectations.php" class="header-menu-elt active">Affectations</a>
            <a href="vehicules.php" class="header-menu-elt">Véhicules</a>
            <a href="ajout-vehicule.php" class="header-menu-elt">Ajouter un véhicule</a>
            <a href="pannes.php" class="header-menu-elt">Historique des pannes</a>
            <a href="declaration-panne.php" class="header-menu-elt">Déclarer une panne</a>
            <a href="parametres.php" class="header-menu-elt">Paramètres</a>
        </center>
    </div>
    <div class="outfit-regular">
        <center><h1>Affectations</h1>
        <button id="btn-valider" onclick="validerModifications()">Valider</button><center>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Modèle</th>
                    <th>Creuses</th>
                    <th>Pointes</th>
                    <th>Soir</th>
                    <th>Nuit</th>
                    <th>Samedi Creuses</th>
                    <th>Samedi Pointes</th>
                    <th>Samedi Soir</th>
                    <th>Samedi Nuit</th>
                    <th>Dimanche Creuses</th>
                    <th>Dimanche Pointe</th>
                    <th>Dimanche Nuit</th>
                </tr>
            </thead>
            <tbody id="vehicules"></tbody>
        </table>
    </div>
    <script>
    const niveau = <?php echo json_encode($niveau); ?>;
    // Fonction pour valider les modifications et les envoyer en AJAX
function validerModifications() {
    console.log("Bouton cliqué !");
    let updates = [];

    document.querySelectorAll("select").forEach(select => {
        let id = select.getAttribute("data-id");
        let name = select.getAttribute("name");
        let value = select.value;

        updates.push({ id, name, value });
        console.log(updates);
    });

    fetch("maj_affectations.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ updates })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Modifications enregistrées !");
        } else {
            alert("Erreur lors de l'enregistrement.");
        }
    })
    .catch(error => console.error("Erreur AJAX :", error));
}

// Récupération des données depuis get_data3.php
fetch("get_data3.php")
    .then(response => response.json())
    .then(data => {
        let tbody = document.getElementById("vehicules");
        data.forEach(vehicule => {
            let row = document.createElement("tr");

            let tdID = `<td>${vehicule.ID}</td>`;
            let tdModele = `<td>${vehicule.Modele}</td>`;

            // Fonction pour créer un menu déroulant avec la valeur actuelle
            
            function createSelect(name, value, niveau) {
                	let options = `<option value="0" ${value === "0" ? "selected" : ""}> </option>`;

    			if (niveau >= 1) options += `<option value="1" ${value === "1" ? "selected" : ""}>Ligne 1</option>`;
    			if (niveau >= 1) options += `<option value="2" ${value === "2" ? "selected" : ""}>Ligne 2</option>`;
    			if (niveau >= 1) options += `<option value="3" ${value === "3" ? "selected" : ""}>Ligne 3</option>`;
    			if (niveau >= 1) options += `<option value="4" ${value === "4" ? "selected" : ""}>Ligne 4</option>`;
    			if (niveau >= 2) options += `<option value="5" ${value === "5" ? "selected" : ""}>Ligne 5</option>`;
    			if (niveau >= 2) options += `<option value="6" ${value === "6" ? "selected" : ""}>Ligne 6</option>`;
    			if (niveau >= 2) options += `<option value="7" ${value === "7" ? "selected" : ""}>Ligne 7</option>`;
    			if (niveau >= 3) options += `<option value="8" ${value === "8" ? "selected" : ""}>Ligne 8</option>`;
    			if (niveau >= 3) options += `<option value="9" ${value === "9" ? "selected" : ""}>Ligne 9</option>`;
    			if (niveau >= 3) options += `<option value="10" ${value === "10" ? "selected" : ""}>Ligne 10</option>`;
    			if (niveau >= 3) options += `<option value="11" ${value === "11" ? "selected" : ""}>Ligne 11</option>`;
    			if (niveau >= 4) options += `<option value="12" ${value === "12" ? "selected" : ""}>Ligne 12</option>`;
    			if (niveau >= 4) options += `<option value="13" ${value === "13" ? "selected" : ""}>Ligne 13</option>`;
    			if (niveau >= 5) options += `<option value="14" ${value === "14" ? "selected" : ""}>Ligne 14</option>`;
    			if (niveau >= 5) options += `<option value="15" ${value === "15" ? "selected" : ""}>Ligne 15</option>`;
    			if (niveau >= 5) options += `<option value="16" ${value === "16" ? "selected" : ""}>Ligne 16</option>`;
    			if (niveau >= 5) options += `<option value="17" ${value === "17" ? "selected" : ""}>Ligne 17</option>`;
    			if (niveau >= 5) options += `<option value="18" ${value === "18" ? "selected" : ""}>Ligne 18</option>`;
    			if (niveau >= 3) options += `<option value="60" ${value === "60" ? "selected" : ""}>Ligne 60</option>`;
    			if (niveau >= 3) options += `<option value="61" ${value === "61" ? "selected" : ""}>Ligne 61</option>`;
    			if (niveau >= 4) options += `<option value="62" ${value === "62" ? "selected" : ""}>Ligne 62</option>`;
    			if (niveau >= 4) options += `<option value="63" ${value === "63" ? "selected" : ""}>Ligne 63</option>`;
    			if (niveau >= 4) options += `<option value="64" ${value === "64" ? "selected" : ""}>Ligne 64</option>`;
    			if (niveau >= 5) options += `<option value="65" ${value === "65" ? "selected" : ""}>Ligne 65</option>`;
    			if (niveau >= 4) options += `<option value="101" ${value === "101" ? "selected" : ""}>Ligne 101</option>`;
    			if (niveau >= 4) options += `<option value="102" ${value === "102" ? "selected" : ""}>Ligne 102</option>`;
    			if (niveau >= 4) options += `<option value="103" ${value === "103" ? "selected" : ""}>Ligne 103</option>`;
    			if (niveau >= 4) options += `<option value="104" ${value === "104" ? "selected" : ""}>Ligne 104</option>`;
    			if (niveau >= 5) options += `<option value="105" ${value === "105" ? "selected" : ""}>Ligne 105</option>`;
    			if (niveau >= 5) options += `<option value="106" ${value === "106" ? "selected" : ""}>Ligne 106</option>`;
    			if (niveau >= 5) options += `<option value="151" ${value === "151" ? "selected" : ""}>Ligne 151</option>`;
    			if (niveau >= 4) options += `<option value="201" ${value === "201" ? "selected" : ""}>Ligne 201</option>`;
    			if (niveau >= 4) options += `<option value="202" ${value === "202" ? "selected" : ""}>Ligne 202</option>`;
    			if (niveau >= 4) options += `<option value="203" ${value === "203" ? "selected" : ""}>Ligne 203</option>`;
    			if (niveau >= 5) options += `<option value="204" ${value === "204" ? "selected" : ""}>Ligne 204</option>`;
    			if (niveau >= 5) options += `<option value="205" ${value === "205" ? "selected" : ""}>Ligne 205</option>`;
    			if (niveau >= 5) options += `<option value="206" ${value === "206" ? "selected" : ""}>Ligne 206</option>`;
    			if (niveau >= 5) options += `<option value="251" ${value === "251" ? "selected" : ""}>Ligne 251</option>`;
    			if (niveau >= 4) options += `<option value="601" ${value === "601" ? "selected" : ""}>Ligne 601</option>`;
    			if (niveau >= 4) options += `<option value="602" ${value === "602" ? "selected" : ""}>Ligne 602</option>`;
    			if (niveau >= 5) options += `<option value="603" ${value === "603" ? "selected" : ""}>Ligne 603</option>`;
    			if (niveau >= 4) options += `<option value="651" ${value === "651" ? "selected" : ""}>Ligne 651</option>`;
    			if (niveau >= 4) options += `<option value="652" ${value === "652" ? "selected" : ""}>Ligne 652</option>`;
    			if (niveau >= 5) options += `<option value="653" ${value === "653" ? "selected" : ""}>Ligne 653</option>`;

    			return `
        		<td>
            			<select name="${name}" data-id="${vehicule.ID}">
                			${options}
            			</select>
        		</td>
                `;
            }
            
            // Version de createSelect spéciale pour les nocturnes 
            function createSelect2(name, value, niveau) {
                let options = `<option value="0" ${value === "0" ? "selected" : ""}> </option>`;

    			if (niveau >= 3) options += `<option value="1001" ${value === "1001" ? "selected" : ""}>Ligne PL1</option>`;
    			if (niveau >= 4) options += `<option value="1002" ${value === "1002" ? "selected" : ""}>Ligne PL2</option>`;
    			if (niveau >= 5) options += `<option value="1003" ${value === "1003" ? "selected" : ""}>Ligne PL3</option>`;

    			return `
        		<td>
            			<select name="${name}" data-id="${vehicule.ID}">
                			${options}
            			</select>
        		</td>
                `;
            }

            let tdHC = createSelect("HC", vehicule.HC, niveau);
            let tdHP = createSelect("HP", vehicule.HP, niveau);
            let tdHS = createSelect("HS", vehicule.HS, niveau);
            let tdHN = createSelect2("HN", vehicule.HN, niveau);
            let tdHSaC = createSelect("HSaC", vehicule.HSaC, niveau);
            let tdHSaP = createSelect("HSaP", vehicule.HSaP, niveau);
            let tdHSaS = createSelect("HSaS", vehicule.HSaS, niveau);
            let tdHSaN = createSelect2("HSaN", vehicule.HSaN, niveau);
            let tdHDC = createSelect("HDC", vehicule.HDC, niveau);
            let tdHDP = createSelect("HDP", vehicule.HDP, niveau);
            let tdHDN = createSelect2("HDN", vehicule.HDN, niveau);

            row.innerHTML = tdID + tdModele + tdHC + tdHP + tdHS + tdHN + tdHSaC + tdHSaP + 
                            tdHSaS + tdHSaN + tdHDC + tdHDP + tdHDN;

            tbody.appendChild(row);
        });
    })
    .catch(error => console.error("Erreur : " + error));
	</script>
</body>
</html>
