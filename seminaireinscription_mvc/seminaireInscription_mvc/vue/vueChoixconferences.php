<?php
include "./vue/entete.php";
print_r($_SESSION);
?>
<form action="./?action=choixconferences" method="POST">
    <table>
       
        <?php
    foreach ($heures as $heure) {
        if (!empty($conferencesParHeure[$heure])) {
            echo "<th>  $heure </th>";
            echo "<th> </th>";
            echo "<th> </th>";
            foreach ($conferencesParHeure[$heure] as $conference) {
                echo "<tr>";
                echo "<td>" . $conference->description . "</td>";
                echo "<td>" . $conference->salle . "</td>";
                echo "<td><input type='radio' name='choix_{$heure}' value='$conference->id'></td>";
                echo "</tr>";
            }
        }
    }
    ?>
    </table>
        <br><br>
    <table>
        <tr>
            <td><input type="submit" value="valider" name="btn"></td>
            <td><input type="reset" value="annuler" name="btn"></td>
        <tr>
    </table>
</form>
<?php
 
?>
<?php
include "./vue/pied.php";
?>