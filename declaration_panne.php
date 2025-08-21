<?php
// Connexion à la base de données
$config = include 'config.php';

$conn = new mysqli($config['host'], $config['user'], $config['pwd'], $config['db']);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupérer les données du formulaire
$id = $_POST['id'];
$date = $_POST['date'];
$TypePanne = $_POST['TypePanne'];
$MontantPanne = $_POST['MontantPanne'];
$PriseEnCharge = $_POST['PriseEnCharge'];

// Préparer la requête SQL pour insérer les données
$sql = "INSERT INTO Pannes (IDVehicule, Date, TypePanne, MontantPanne, PriseEnCharge) 
        VALUES (?, ?, ?, ?, ?)";

// Préparer et lier les paramètres
$stmt = $conn->prepare($sql);
$stmt->bind_param("issis", $id, $date, $TypePanne, $MontantPanne, $PriseEnCharge);

// Vérifier l'exécution de la requête
if ($stmt->execute()) {
    echo "Panne déclarée avec succès !<br/>";
    echo "Vous serez automatiquement redirigé à l'historique des pannes dans 2 secondes";
    echo '<script>
        setTimeout(function() {
            window.location.href = "pannes.php";
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
