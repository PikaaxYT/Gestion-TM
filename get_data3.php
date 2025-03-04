<?php
// Connexion à la base de données
$config = include 'config.php';

$conn = new mysqli($config['host'], $config['user'], $config['pwd'], $config['db']);

// Vérification de la connexion
if ($conn->connect_error) {
    die(json_encode(["error" => "Échec de la connexion : " . $conn->connect_error]));
}

// Requête SQL pour récupérer les véhicules
$sql = "SELECT Vehicules.ID, Vehicules.Modele, 
               Affectations.HC, Affectations.HP, Affectations.HS, Affectations.HSaC, Affectations.HSaP, Affectations.HDC, Affectations.HDP
        FROM Vehicules 
        LEFT JOIN Affectations ON Vehicules.ID = Affectations.ID 
        ORDER BY Vehicules.ID ASC";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'ID' => $row['ID'],
            'Modele' => !empty($row['Modele']) ? $row['Modele'] : '?',
            'HC' => !empty($row['HC']) ? $row['HC'] : " ",
            'HP' => !empty($row['HP']) ? $row['HP'] : " ",
            'HS' => !empty($row['HS']) ? $row['HS'] : " ",
            'HSaC' => !empty($row['HSaC']) ? $row['HSaC'] : " ",
            'HSaP' => !empty($row['HSaP']) ? $row['HSaP'] : " ",
            'HSaS' => !empty($row['HSaS']) ? $row['HSaS'] : " ",
            'HDC' => !empty($row['HDC']) ? $row['HDC'] : " ",
            'HDP' => !empty($row['HDP']) ? $row['HDP'] : " ",
        ];
    }
}

echo json_encode($data);
$conn->close();
?>
