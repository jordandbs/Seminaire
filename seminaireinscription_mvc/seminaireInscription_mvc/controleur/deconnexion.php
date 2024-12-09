<?php
include 'fonctionsGestion.php';
deconnexion();


session_start(); // Démarrer la session

// Détruire toutes les variables de session
$_SESSION = [];

// Détruire la session
session_destroy();

// Rediriger vers la page de connexion
header('Location: connexion.php');
exit;
?>