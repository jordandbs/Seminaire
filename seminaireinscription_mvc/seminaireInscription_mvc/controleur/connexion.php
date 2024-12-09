<?php
include "./fonctions/fonctionsGestion.php";
include "./fonctions/fonctionsAccesDonnees.php";

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = isset($_POST['login']) ? $_POST['login'] : '';
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';

    if (!empty($login) && !empty($mdp)) {
        if (verifier($login, $mdp)) {
            header('Location: voirinscriptions.php');
            exit();
        } else {
            $erreur = "Identifiants incorrects. Veuillez réessayer.";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs.";
    }
}

include "./vue/vueConnexion.php";
?>
</body> 
</html>