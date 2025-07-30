<?php
session_start();

$config = include 'config.php';

$conn = new mysqli($config['host'], $config['user'], $config['pwd'], $config['db']);

// Récupération des données du formulaire
$mdp = $_POST['password'];
$id = 1;

$sql = "SELECT u.MDP, u.Niveau
        FROM Utilisateur u
        WHERE u.ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Vérification du mot de passe
if ($user && password_verify($mdp, $user['MDP'])) {
    $_SESSION['niveau'] = $user['Niveau'];
    header("Location: accueil.php");
    exit;
} else {
    echo "Mot de passe incorrect.";
}

// Fermer la connexion à la base de données
$conn->close();
?>
