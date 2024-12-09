<?php
include "./fonctions/fonctionsGestion.php";
include "./fonctions/fonctionsAccesDonnees.php";

$btn = "Inscription";
if (isset($_POST["btn"])){
	$btn = $_POST["btn"];
}

switch ($btn){
	case "Annuler" :
      $nom = '';
      $prenom = '';
      $mail = '';
      $ville = '';

		break;
		
	case "Valider" :
      $nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$mail = $_POST['mail'];
		$ville = $_POST['ville'];
		$profession = $_POST['profession'];

	  verifierDonneesInscription($nom, $prenom, $mail, $ville);
	  donnerNbErreurs();
	  if (donnernbErreurs() == 0) {
	  echo "<h2>Votre inscription a été prise en compte, il faut procéder au choix des conférences</h2>";
	  sauverDonneesInscription($nom, $prenom, $mail, $ville, $profession);
	  } else {
	  afficherErreurs();
	  }
		    break;
}

include "./vue/vueInscription.php";
?>