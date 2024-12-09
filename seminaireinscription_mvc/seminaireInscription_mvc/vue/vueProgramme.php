<?php
include "./vue/entete.php";
?>
<table>  
<?php
    foreach ($lesCreneaux as $creneau) {
        echo "<tr>";
            echo "<th>$creneau</th>";
            echo "<th>Intervenant</th>";
            echo "<th>Salle</th>";
        echo "</tr>";
        foreach ($lesConferencesParCreneau[$creneau] as $conference) {
            echo "<tr>";
                echo "<td>$conference->description</td>";
                echo "<td>$conference->intervenant</td>";
                echo "<td>$conference->salle</td>";
            echo "</tr>";
        }
    }
?> 
</table>
<?php
include "./vue/pied.php";
?>