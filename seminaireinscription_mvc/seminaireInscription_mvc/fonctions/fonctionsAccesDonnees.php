    <?php
    /**
     * @access private
     * @return type
     */
    function chargeJSONseminaire()
    {
        $json_source = file_get_contents('data/seminaire.json');
        $document = json_decode($json_source);
        return $document;
    }

    /**
     * @access private
     * @return type
     */
    function chargeJSONprofessions()
    {
        $json_source = file_get_contents('data/professions.json');
        $document = json_decode($json_source);
        return $document;
    }

    /**
     * @access private
     * @param type $doc
     */
    function sauveJSONseminaire($doc){
        $json_source = file_get_contents('data/seminaireSauve.json');
        $doc = json_decode($json_source);
        file_put_contents('data/seminaireSauve.json', json_encode($doc, JSON_PRETTY_PRINT));
        return $doc;
    }   

    /**
     * @access private
     * @return type
     */
    function chargeJSONadmin()
    {
        $json_source = file_get_contents('./data/admin.json');
        $document = json_decode($json_source);
        return $document;
    }

    /**
     * Retourne l'intitulé du séminaire
     * @return chaîne
     */
    function donnerIntituleSeminaire()
    {
        $seminaire = chargeJSONseminaire();
        return $seminaire->seminaire->intitule;
    }

    /**
     * Retourne la liste de tous les créneaux horaires, heures de début des conférences
     * le tableau retourné commence à l'indide 0
     * @return  tableau 
     * 
     */
    function donnerLesHeuresCreneaux(){
        $seminaire = chargeJSONseminaire();
        $creneaux = [];
        foreach ($seminaire->seminaire->creneau as $creneau) {
            $creneaux[] = $creneau->heure;
        }
        return $creneaux;
    }
    /**
     * Retourne toutes les conférences commençant à l'heure donnée sous forme d'un tableau
     * @param chaîne $heure
     * @return  tableau 
     */
    function donnerLesConferences($heure)
    {
        $seminaire = chargeJSONseminaire();
        $conferences = array();
        foreach ($seminaire->seminaire->creneau as $creneau) {
            if ($creneau->heure == $heure) {
                foreach ($creneau->conference as $conf) {
                    $conferences[] = $conf;
            }
        }
    }
        return $conferences;
    }

    /**
     * Enregistre les informations d'un visiteur
     * @param chaîne $nom
     * @param chaîne $prenom
     * @param chaîne $mail
     * @param chaîne $ville
     * @param chaîne $profession
     */
    function sauverDonneesInscription($nom, $prenom, $mail, $ville, $profession)
    {
        session_start();
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['mail'] = $mail;
        $_SESSION['ville'] = $ville;
        $_SESSION['profession'] = $profession;
    }


    /**
     * Retourne toutes les professions possibles
     * le tableau retourné commence à l'indice 0
     * @return  tableau 
     */
    function donnerLesProfessions()
    {
        $professions = chargeJSONprofessions();
        return $professions->professions;
    }


    /**
     * Vérifie si le visiteur a déjà rempli son formulaire d'inscription
     * @return boolean
     */
    function estInscrit()
    {
        return isset($_SESSION['nom']) 
        && isset($_SESSION['prenom']) 
        && isset($_SESSION['mail']);
        
    }
    
    /**
     * Enregistre un participant et ses choix de conférences
     * @param tableau $lesChoix : les choix du participant
     */
    function enregistre($leschoix) {
        // Charger les données du fichier séminaire
        $json_source = file_get_contents('data/seminaire.json');
        $document = json_decode($json_source);
        return $document;
        $data = json_decode($json, true); // Décoder en tableau associatif
        
        // Informations du participant (tirées de la session par exemple)
        $participant = [
            'nom' => $_SESSION['nom'],        // Nom du participant
            'prenom' => $_SESSION['prenom'],  // Prénom du participant
            'profession' => $_SESSION['profession'], // Profession
            'ville' => $_SESSION['ville'],    // Ville
            'mail' => $_SESSION['mail'],      // Email du participant
            'choix' => []                     // Tableau pour stocker les choix des conférences
        ];
    
        // Parcourir les choix envoyés par l'utilisateur
        foreach ($leschoix as $heure => $conferenceId) {
            // Parcourir chaque créneau dans le fichier séminaire
            foreach ($data['seminaire']['creneau'] as &$creneau) {
                if ($creneau['heure'] == $heure) {
                    // Parcourir chaque conférence de ce créneau
                    foreach ($creneau['conference'] as &$conference) {
                        if ($conference['id'] == $conferenceId) {
                            // Ajouter les informations du participant à cette conférence
                            $conference['participants'][] = $participant;
    
                            // Stocker le choix dans les informations du participant (facultatif)
                            $participant['choix'][] = $conferenceId;
                        }
                    }
                }
            }
        }
    
        // Sauvegarder les modifications dans le fichier JSON
        file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT));
    
        // Retourner un message de confirmation (facultatif)
        return "Les choix du participant ont été enregistrés avec succès.";
    }
    

    /**
     * Retourne toutes conférences sous forme d'un tableau
     * Le tableau commençe à l'indice 0
     * Chaque ligne du tableau contient les information sur une conférence :
     * son id, son creneau,sa description, son intervenant, sa salle et son nbPlaces
     * @return tableau
     */
    function donnerToutesLesConferences() {
    $json_source = file_get_contents('data/seminaire.json');
    $document = json_decode($json_source, true);
    return $document;

    $conferences = [];

    foreach ($data['seminaire']['creneau'] as $creneau) {
        foreach ($creneau['conference'] as $conference) {
            $conferences[] = [
                'id' => $conference['id'],
                'heure' => $creneau['heure'],
                'description' => $conference['description'],
                'intervenant' => $conference['intervenant'],
                'salle' => $conference['salle'],
                'nbplaces' => $conference['nbplaces']
            ];
        }
    }

    return $conferences;
}

    /**
     * Retourne tous les participants inscrits à une conférence dont on fournit le numéro
     * Chaque ligne du tableau retourné contient le nom, le prénom, la profession,
     * la ville et le mail d'un participant
     * @param entier $numConference
     * @return  tableau 
     */
    function donnerParticipants($numConference) {
        $json_source = file_get_contents('data/seminaire.json');
        $document = json_decode($json_source, true);
        return $document;
        
        $participants = [];
    
        foreach ($data['seminaire']['creneau'] as $creneau) {
            foreach ($conference['conference'] as $conference) {
                if ($conference['id'] == $numConference) {
                    foreach ($conference['participants'] as $participant) {
                        $participants[] = [
                            'nom' => $participant['nom'],
                            'prenom' => $participant['prenom'],
                            'profession' => $participant['profession'],
                            'ville' => $participant['ville'],
                            'mail' => $participant['mail']
                        ];
                    }
                }
            }
        }
        return $participants;
    }
?>