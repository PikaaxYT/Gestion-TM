<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$config = include 'config.php';
$conn = new mysqli($config['host'], $config['user'], $config['pwd'], $config['db']);

if ($conn->connect_error) {
  http_response_code(500);
  exit('Erreur connexion BDD : ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  exit('Erreur : méthode POST requise');
}

$id = $_POST['id'] ?? null;
$champ = $_POST['champ'] ?? null;
$valeur = $_POST['valeur'] ?? null;

if ($id === null || $champ === null || $valeur === null) {
  http_response_code(400);
  exit('Paramètres manquants');
}

$champs_valides = ['KM', 'EtatTechnique', 'EtatInterieur', 'CT', 'Revision', 'Argus'];
if (!in_array($champ, $champs_valides)) {
  http_response_code(400);
  exit('Champ invalide');
}

$stmt = $conn->prepare("UPDATE Vehicules SET $champ = ? WHERE id = ?");
if (!$stmt) {
  http_response_code(500);
  exit('Erreur préparation requête : ' . $conn->error);
}

$champs_types = [
    'KM' => 'i',
    'EtatTechnique' => 'i',
    'EtatInterieur' => 'i',
    'CT' => 's',
    'Revision' => 's',
    'Argus' => 'i',
];

$type_param = $champs_types[$champ];

if ($type_param === 'i') {
    $valeur = (int) $valeur;
    $stmt->bind_param('ii', $valeur, $id);
    if (!$stmt->execute()) {
       http_response_code(500);
       exit('Erreur exécution requête : ' . $stmt->error);
    }
} else if ($type_param === 's') {
    $stmt->bind_param('si', $valeur, $id);
    if (!$stmt->execute()) {
       http_response_code(500);
       exit('Erreur exécution requête : ' . $stmt->error);
    }
}

echo 'OK';
