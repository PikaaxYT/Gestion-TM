<?php
// Démarre la session
session_start();

// Détruire toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

echo '<p>Vous êtes déconnecté. Redirection en cours...</p>';
header("refresh:2;url=login.html");
exit;
?>
