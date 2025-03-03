<?php
// Connexion à la base de données
$config = include 'config.php';

$conn = new mysqli($config['host'], $config['user'], $config['pwd'], $config['db']);

// Vérification de la connexion
if ($conn->connect_error) {
    die(json_encode(["error" => "Échec de la connexion : " . $conn->connect_error]));
}

// Requête SQL pour récupérer les véhicules
$sql = "SELECT * FROM Pannes ORDER BY Date DESC";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'IDVehicule' => $row['IDVehicule'],
            'Date' => !empty($row['Date']) && $row['Date'] != '0000-00-00' ? date('Y-m-d', strtotime($row['Date'])) : 'Date Inconnue',
            'TypePanne' => !empty($row['TypePanne']) ? $row['TypePanne'] : "Inconnu",
            'MontantPanne' => !empty($row['MontantPanne']) ? $row['MontantPanne'] : "Inconnu",
            'PriseEnCharge' => !empty($row['PriseEnCharge']) ? $row['PriseEnCharge'] : "Inconnue",
        ];
    }
}

echo json_encode($data);
$conn->close();
?>
