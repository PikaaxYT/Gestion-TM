<?php
// Connexion à la base de données
$config = include 'config.php';

$conn = new mysqli($config['host'], $config['user'], $config['pwd'], $config['db']);

// Vérification de la connexion
if ($conn->connect_error) {
    die(json_encode(["error" => "Échec de la connexion : " . $conn->connect_error]));
}

// Requête SQL pour récupérer les véhicules
$sql = "SELECT * FROM Vehicules ORDER BY ID ASC";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'ID' => $row['ID'],
            'Modele' => !empty($row['Modele']) ? $row['Modele'] : "?",
            'TypeVehicule' => !empty($row['TypeVehicule']) ? $row['TypeVehicule'] : "?",
            'Categorie' => !empty($row['Categorie']) ? $row['Categorie'] : "?",
            'Carburant' => !empty($row['Carburant']) ? $row['Carburant'] : "?",
            'Places' => !empty($row['Places']) ? $row['Places'] : "?",
            'KM' => !empty($row['KM']) ? $row['KM'] : "?",
            'EtatTechnique' => !empty($row['EtatTechnique']) ? $row['EtatTechnique'] : "?",
            'EtatInterieur' => !empty($row['EtatInterieur']) ? $row['EtatInterieur'] : "?",
		'MES' => !empty($row['MES']) && $row['MES'] != '0000-00-00' ? date('Y-m-d', strtotime($row['MES'])) : '?',
		'Garantie' => !empty($row['Garantie']) && $row['Garantie'] != '0000-00-00' ? date('Y-m-d', strtotime($row['Garantie'])) : 'Non',
		'CT' => !empty($row['CT']) && $row['CT'] != '0000-00-00' ? date('Y-m-d', strtotime($row['CT'])) : '?',
            'Revision' => !empty($row['Revision']) && $row['Revision'] != '0000-00-00' ? date('Y-m-d', strtotime($row['Revision'])) : 'Jamais',
            'Argus' => !empty($row['Argus']) ? $row['Argus']: '?',
            'Statut' => !empty($row['Statut'])  ? $row['Statut'] : '?',
        ];
    }
}

echo json_encode($data);
$conn->close();
?>
