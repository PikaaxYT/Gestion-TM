<?php
// Connexion à la base de données
$config = include 'config.php';

$conn = new mysqli($config['host'], $config['user'], $config['pwd'], $config['db']);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupérer les données du formulaire (sauf ID)
$typeVehicule = $_POST['type_vehicule'];
$categorie = $_POST['categorie'];
$modele = $_POST['modele'];
$carburant = $_POST['carburant'];
$places = $_POST['places'];
$km = $_POST['km'];
$etat_technique = $_POST['etat_technique'];
$etat_interieur = $_POST['etat_interieur'];
$mes = $_POST['mes'];
$garantie = $_POST['garantie'];
$ct = $_POST['ct'];
$revision = $_POST['revision'];
$argus = $_POST['argus'];
$statut = $_POST['statut'];

// Fonction pour le calcul de l'ID
function getNextID($conn, $typeVehicule, $categorie) {
    // Définition des préfixes par type de véhicule (pour véhicules en service commercial)
    $prefixes = [
        "Minibus" => 100, "Midibus" => 200, "Standard" => 300, "Articule" => 400,
        "StandardBHNS" => 500, "ArticuleBHNS" => 600, "StandardLE" => 700, 
        "ArticuleLE" => 800, "Autocar" => 900
    ];

    // Vérification du préfixe selon le type de véhicule
    if (!isset($prefixes[$typeVehicule])) {
        return null; // Type non reconnu
    }

    $prefix = $prefixes[$typeVehicule];

    // Gestion spécifique pour Parc Musée (83xx, 84xx, etc.) et Réserve (92xx, 93xx, etc.)
    if ($categorie === "ParcMusee") {
        // Utiliser les préfixes pour Parc Musée en fonction des préfixes d'origine pour Service Commercial
        if ($prefix == 300) {
            $prefix = 8300; // Standard Musée
        } elseif ($prefix == 400) {
            $prefix = 8400; // Articulé Musée
        } elseif ($prefix == 500) {
            $prefix = 8500; // Standard BHNS Musée
        } elseif ($prefix == 600) {
            $prefix = 8600; // Articulé BHNS Musée
        } elseif ($prefix == 700) {
            $prefix = 8700; // Standard LE Musée
        } elseif ($prefix == 800) {
            $prefix = 8800; // Articulé LE Musée
        } elseif ($prefix == 900) {
            $prefix = 8900; // Autocar Musée
        }
    } elseif ($categorie === "Reserve") {
        // Utiliser les préfixes pour Réserve en fonction des préfixes d'origine pour Service Commercial
        if ($prefix == 300) {
            $prefix = 9300; // Standard Réserve
        } elseif ($prefix == 400) {
            $prefix = 9400; // Articulé Réserve
        } elseif ($prefix == 500) {
            $prefix = 9500; // Standard BHNS Réserve
        } elseif ($prefix == 600) {
            $prefix = 9600; // Articulé BHNS Réserve
        } elseif ($prefix == 700) {
            $prefix = 9700; // Standard LE Réserve
        } elseif ($prefix == 800) {
            $prefix = 9800; // Articulé LE Réserve
        } elseif ($prefix == 900) {
            $prefix = 9900; // Autocar Réserve
        }
    }

    // Trouver le dernier ID utilisé dans cette plage
    $sql = "SELECT MAX(ID) AS lastID FROM Vehicules WHERE ID BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $upperBound = $prefix + 99;  // Plage du préfixe (ex: 8300-8399)
    $stmt->bind_param("ii", $prefix, $upperBound);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result === false) {
        die("Erreur de requête SQL : " . $stmt->error);
    }

    $row = $result->fetch_assoc();

    // Calcul du prochain ID disponible
    $newID = ($row['lastID']) ? $row['lastID'] + 1 : $prefix;

    return $newID;
}

// Récupérer l'ID
$id = getNextID($conn, $typeVehicule, $categorie);

// Vérification si un ID a bien été généré
if (!$id) {
    die("Erreur : Impossible de générer un ID valide.");
}

// Préparer la requête SQL pour insérer les données
$sql = "INSERT INTO Vehicules (ID, TypeVehicule, Categorie, Modele, Carburant, Places, KM, EtatTechnique, EtatInterieur, MES, Garantie, CT, Revision, Argus, Statut) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Préparer et lier les paramètres
$stmt = $conn->prepare($sql);
$stmt->bind_param("issssiiiissssis", $id, $typeVehicule, $categorie, $modele, $carburant, $places, $km, $etat_technique, $etat_interieur, $mes, $garantie, $ct, $revision, $argus, $statut);

// Vérifier l'exécution de la requête
if ($stmt->execute()) {
    echo "Véhicule ajouté avec succès !<br>";
    echo "Vous serez automatiquement redirigé à la liste des véhicules dans 2 secondes";
    echo '<script>
        setTimeout(function() {
            window.location.href = "vehicules.php";
        }, 2000);
    </script>';
} else {
    // Afficher l'erreur d'exécution
    echo "Erreur lors de l'exécution de la requête : " . $stmt->error . "<br>";
    // Afficher les erreurs détaillées
    var_dump($stmt->error_list); // Afficher les erreurs détaillées
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>
