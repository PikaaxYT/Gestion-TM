<?php
$config = include 'config.php';
$conn = new mysqli($config['host'], $config['user'], $config['pwd'], $config['db']);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Échec de la connexion : " . $conn->connect_error]));
}

// Récupération des données envoyées en JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['updates'])) {
    foreach ($data['updates'] as $update) {
        $id = intval($update['id']);
        $column = $conn->real_escape_string($update['name']);
        $value = $conn->real_escape_string($update['value']);

        // Vérifier si le véhicule a déjà une affectation
        $checkQuery = "SELECT ID FROM Affectations WHERE ID = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Mise à jour si l'ID existe déjà
            $query = "UPDATE Affectations SET $column = ? WHERE ID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $value, $id);
        } else {
            // Insertion si l'ID n'existe pas
            $query = "INSERT INTO Affectations (ID, $column) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("is", $id, $value);
        }

        $stmt->execute();
        $stmt->close();
    }
    
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Aucune donnée reçue"]);
}

$conn->close();
?>
