<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$config = include 'config.php';

$conn = new mysqli($config['host'], $config['user'], $config['pwd'], $config['db']);

// Vérification de la connexion
if ($conn->connect_error) {
    die(json_encode(["error" => "Échec de la connexion : " . $conn->connect_error]));
}


// Table Véhicules
$conn->query("
	CREATE TABLE IF NOT EXISTS Vehicules (
		ID INT AUTO_INCREMENT PRIMARY KEY,
		Modele VARCHAR(255),
		TypeVehicule VARCHAR(255),
		Categorie VARCHAR(255),
		Carburant VARCHAR(255),
		Places INT,
		KM INT,
		EtatTechnique INT,
		EtatInterieur INT,
		MES DATE,
		Garantie DATE,
		CT DATE,
		Revision DATE,
		Argus INT,
		Statut VARCHAR(255)
	);
");

// Table Pannes
$conn->query("
	CREATE TABLE IF NOT EXISTS Pannes (
		IDPanne INT AUTO_INCREMENT PRIMARY KEY,
		IDVehicule INT,
		Date DATE,
		TypePanne VARCHAR(255),
		MontantPanne INT,
		PriseEnCharge VARCHAR(255),
		
		FOREIGN KEY (IDVehicule) REFERENCES Vehicules(ID)
	);
");

// Table Affectations
$conn->query("
	CREATE TABLE IF NOT EXISTS Affectations (
		ID INT,
		HC INT,
		HP INT,
		HS INT,
		HN INT,
		HSaC INT,
		HSaP INT,
		HSaS INT,
		HSaN INT,
		HDC INT,
		HDP INT,
		HDN INT,
		
		FOREIGN KEY (ID) REFERENCES Vehicules(ID)
	);
");

// Table Utilisateur
$conn->query("
	CREATE TABLE IF NOT EXISTS Utilisateur (
		ID INT PRIMARY KEY,
		MDP VARCHAR(255),
		Niveau INT
	);
");

$result = $conn->query("SELECT MDP FROM Utilisateur WHERE id = 1");

if ($result && $row = $result->fetch_assoc()) {
    if (empty($row['MDP'])) {
        $mdp = 'azerty';
        $hash = password_hash($mdp, PASSWORD_DEFAULT);
        $conn->query("UPDATE Utilisateur SET MDP = '$hash' WHERE ID = 1");
    }
} else {
    $mdp = 'azerty';
    $hash = password_hash($mdp, PASSWORD_DEFAULT);
    $conn->query("INSERT INTO Utilisateur (ID, MDP, Niveau) VALUES (1, '$hash', 0)");
}

echo "Les tables SQL ont été créées avec succès !";
echo "Vous serez automatiquement redirigé à l'accueil dans 2 secondes";
    echo '<script>
        setTimeout(function() {
            window.location.href = "accueil.php";
        }, 2000);
    </script>';
?>