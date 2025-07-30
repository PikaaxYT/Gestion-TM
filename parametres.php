<?php

session_start();

if (!isset($_SESSION['niveau'])) {
    header("Location: login.html");
    exit;
}

$config = include 'config.php'; // Connexion MySQL
$conn = new mysqli($config['host'], $config['user'], $config['pwd'], $config['db']);

// Récupérer les données de l'utilisateur connecté
$user_id = 1;

// Traitement du formulaire de changement de mot de passe
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ancien_mdp = $_POST['mdp'];
    $nouveau_mdp = $_POST['mdp2'];
    $confirmation_mdp = $_POST['mdp3'];

    // Vérifier que les mots de passe sont identiques
    if ($nouveau_mdp !== $confirmation_mdp) {
        $message = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérifier l'ancien mot de passe
        $sql = "SELECT MDP FROM Utilisateur WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (password_verify($ancien_mdp, $user['MDP'])) {
            // Mettre à jour le mot de passe
            $nouveau_mdp_hash = password_hash($nouveau_mdp, PASSWORD_DEFAULT);

            $update_sql = "UPDATE Utilisateur SET MDP = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $nouveau_mdp_hash, $user_id);
            if ($update_stmt->execute()) {
                $message = "Votre mot de passe a été modifié avec succès.";
                header("refresh:1;url=logoff.php");
            } else {
                $message = "Une erreur est survenue, veuillez réessayer.";
            }
        } else {
            $message = "L'ancien mot de passe est incorrect.";
        }
    }
}
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="styles.css" rel="stylesheet">
    <link href="fonts.css" rel="stylesheet">
    <title>Paramètres - Outil de gestion TM (par Pikaax)</title>
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
            <a href="declaration-panne.php" class="header-menu-elt">Déclarer une panne</a>
            <a href="parametres.php" class="header-menu-elt active">Paramètres</a>
        </center>
    </div>
    <br>
    <div class="outfit-regular">
    <div class="formulaire">
    <center>
        <h1>Sélectionnez votre niveau en jeu</h1>
    </center>
           <form action="changer_nv.php" method="POST">
        
        <label for="nv">Niveau jeu:</label>
        <select id="nv" name="nv" required>
        	<option value="1">Niveau 1</option>
        	<option value="2">Niveau 2</option>
        	<option value="3">Niveau 3</option>
        	<option value="4">Niveau 4</option>
        	<option value="5">Niveau 5</option>
        </select>
        <br/>

        <button type="submit">Valider</button>
    </form>
    </div>
    <br>
    <div class="formulaire">
    <center>
        <h1>Changer le mot de passe</h1>
    </center>
           <form action="parametres.php" method="POST">
        
        <label for="mdp">Mot de passe actuel:</label>
        <input type="password" id="mdp" name="mdp" required><br/>

        <label for="mdp2">Nouveau mot de passe:</label>
        <input type="password" id="mdp2" name="mdp2" required><br/>
        
        <label for="mdp2">Confirmation du nouveau mot de passe:</label>
        <input type="password" id="mdp3" name="mdp3" required><br/>

        <button type="submit">Valider</button>
    </form>
    </div>
</body>
</html>
