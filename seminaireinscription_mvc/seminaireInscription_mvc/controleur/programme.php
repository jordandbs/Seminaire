<?php
include "fonctions/fonctionsAccesDonnees.php";
 
$lesCreneaux = donnerLesHeuresCreneaux();
 
$lesConferencesParCreneau = array();
foreach ($lesCreneaux as $creneau) {
    $lesConferencesParCreneau[$creneau] = donnerLesConferences($creneau);
}
 
include_once "vue/vueProgramme.php";