<?php
session_start(); 

include './fonctions/fonctionsGestion.php';
include './fonctions/fonctionsAccesDonnees.php';

if (!estAdmin()) {
    header('Location: connexion.php'); 
    exit;
}
$conferences = donnerToutesLesConferences();
include './vue/vueVoirinscriptions.php';
?>