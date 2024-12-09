<?php 
include "./vue/entete.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $ville = $_POST['ville'];
    $profession = $_POST['profession'];

}
?>

<form action="./?action=inscription" method="POST">
   <table>
      <tr>
         <td>Nouvelle inscription</td>
      </tr>
      <tr>
         <td> Nom*: </td>
         <td><input type="text" name="nom" value="" size="30"></td>
      </tr>
      <tr>
         <td> Prenom*: </td>
         <td><input type="text" name="prenom" value="" size="30"></td>
      </tr>
      <tr>
         <td> mail*: </td>
         <td><input type="text" name="mail" value="" size="30"></td>
      </tr>
      <tr>
         <td> Ville*: </td>
         <td><input type="text" name="ville"  value="" size="30"></td>
      </tr>
      <tr>
         <td> Profession*: </td>
         <td><SELECT name= "profession">
         <?php
        $professions = donnerLesProfessions();
        foreach ($professions as $profession) {
            echo "<option value='$profession'>$profession</option>";
        }
        ?>
             </SELECT>
        </td>
      </tr> </table>
 
    <br>
    <table>
      <tr>
         <td ><input type="submit" value="Valider" name="btn">
         </td>
         <td ><input type="reset" value="Annuler" name="btn">
         </td>
      </tr>
      
   </table>
</form>
<?php 
include "./vue/pied.php";
?>
