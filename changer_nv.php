<?php

$config = include 'config.php'; // Connexion MySQL
$conn = new mysqli($config['host'], $config['user'], $config['pwd'], $config['db']);

// Récupérer les données de l'utilisateur connecté
$user_id = 1;

// Traitement du formulaire de changement de mot de passe
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $niveau = $_POST['nv'];
    $update_sql = "UPDATE Utilisateur SET Niveau = ? WHERE id = ?";
     $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ii", $niveau, $user_id);
            if ($update_stmt->execute()) {
                $message = "Votre niveau a été modifié avec succès.";
                $_SESSION['niveau'] = $niveau;
                header("refresh:1;url=accueil.php");
            } else {
                $message = "Une erreur est survenue, veuillez réessayer.";
            }
}
    
?>