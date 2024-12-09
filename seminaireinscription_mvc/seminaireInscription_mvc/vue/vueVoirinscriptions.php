<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des inscriptions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Liste des inscriptions pour les conférences</h1>

    <?php
    if (!empty($conferences)) {
        foreach ($conferences as $conference) {
            echo "<h2>Conférence : " . htmlspecialchars($conference['description']) . "</h2>";
            echo "<p>Intervenant : " . htmlspecialchars($conference['intervenant']) . "</p>";
            echo "<p>Salle : " . htmlspecialchars($conference['salle']) . "</p>";
            echo "<p>Heure : " . htmlspecialchars($conference['heure']) . "</p>";
            echo "<p>Nombre de places : " . htmlspecialchars($conference['nbplaces']) . "</p>";

            // Récupérer les participants pour cette conférence
            $participants = donnerParticipants($conference['id']);

            // Vérifier que la variable $participants est un tableau valide et non vide
            if (is_array($participants) && count($participants) > 0) {
                echo "<table>";
                echo "<tr><th>Nom</th><th>Prénom</th><th>Profession</th><th>Ville</th><th>Email</th></tr>";

                // Parcourir les participants et afficher leurs informations
                foreach ($participants as $participant) {
                    // Vérifier que chaque participant a les champs requis
                    if (isset($participant['nom'], $participant['prenom'], $participant['profession'], $participant['ville'], $participant['mail'])) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($participant['nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($participant['prenom']) . "</td>";
                        echo "<td>" . htmlspecialchars($participant['profession']) . "</td>";
                        echo "<td>" . htmlspecialchars($participant['ville']) . "</td>";
                        echo "<td>" . htmlspecialchars($participant['mail']) . "</td>";
                        echo "</tr>";
                    } else {
                        echo "<tr><td colspan='5'>Données du participant manquantes ou incomplètes.</td></tr>";
                    }
                }

                echo "</table>";
            } else {
                echo "<p>Aucun participant inscrit pour cette conférence.</p>";
            }
        }
    } else {
        echo "<p>Aucune conférence disponible.</p>";
    }
    ?>
    
    <form method="post" action="deconnexion.php">
        <button type="submit">Se déconnecter</button>
    </form>
</body>
</html>

</body>
</html>
