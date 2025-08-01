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
	<title>Accueil - Outil de gestion TM (par Pikaax)</title>
</head>
<body>
	<div class="header outfit-regular">
		<center><h1>Outil de gestion TM</h1></center>
	</div>
		<div class="header-menu outfit-regular">
		<center>        
		<a href="http://pikaax.rf.gd/index.html" class="header-menu-elt">Retour au site</a>
            <a href="accueil.php" class="header-menu-elt active">Accueil</a>
            <a href="affectations.php" class="header-menu-elt">Affectations</a>
            <a href="vehicules.php" class="header-menu-elt">Véhicules</a>
            <a href="ajout-vehicule.php" class="header-menu-elt">Ajouter un véhicule</a>
            <a href="pannes.php" class="header-menu-elt">Historique des pannes</a>
            <a href="declaration-panne.php" class="header-menu-elt">Déclarer une panne</a>
            <a href="parametres.php" class="header-menu-elt">Paramètres</a>
		</center>
		</div>
		<div class="outfit-regular">
			<p>Cet outil vous permet de visualiser l'ensemble de vos véhicules sur Transport-Manager sans avoir à vous connecter en jeu</p>
<?php
// 1. Version locale
$localVersion = '1.3.1';

// 2. Récupération de la dernière release sur GitHub
$repo = 'PikaaxYT/Gestion-TM';
$apiUrl = "https://api.github.com/repos/$repo/releases/latest";

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERAGENT => 'PHP Check Update',
]);

$response = curl_exec($curl);
curl_close($curl);

$data = json_decode($response, true);
$latestVersion = $data['tag_name'] ?? null;

if ($latestVersion) {
    // 3. Comparaison
    if (version_compare($localVersion, $latestVersion, '<')) {
        echo "🚨 Une nouvelle version est disponible : $latestVersion (actuellement : $localVersion)";
    } else {
        echo "✅ Vous êtes à jour (version $localVersion)";
    }
} else {
    echo "❌ Impossible de vérifier la version.";
}
?>

		</div>
</body>