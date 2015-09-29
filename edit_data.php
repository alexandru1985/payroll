<?php
$host = "localhost";
$user = "root";
$password = "";
$datbase = "payroll";
mysql_connect($host,$user,$password);
mysql_select_db($datbase);

if(isset($_GET['edit_id']))
{
 $sql_query="SELECT date_principale.*,date_personale.Varsta,date_personale.Vechime,
totaluri.Suma_comision, beneficii.Prime, totaluri.Total_salariu
FROM date_principale 
LEFT JOIN beneficii ON date_principale.Id = beneficii.Id 
LEFT JOIN totaluri ON date_principale.Id = totaluri.Id  
LEFT JOIN date_personale ON date_principale.Id = date_personale.Id 
 WHERE  totaluri.Id  =".$_GET['edit_id'];
 $result_set=mysql_query($sql_query) or die(mysql_error());
 $fetched_row=mysql_fetch_array($result_set);
}
if(isset($_POST['btn-update']))
{

 $upd_oras = $_POST['upd_oras'];
 $upd_angajat = $_POST['upd_angajat'];
 $upd_functie = $_POST['upd_functie'];
 $upd_varsta = $_POST['upd_varsta'];
 $upd_vechime = $_POST['upd_vechime'];
 $upd_salariu_baza = $_POST['upd_salariu_baza'];
 $upd_suma_comision = $_POST['upd_suma_comision'];
 $upd_prime= $_POST['upd_prime'];
 $upd_total_salariu = $_POST['upd_total_salariu'];


 $sql_query = " UPDATE  date_principale 
LEFT JOIN beneficii ON date_principale.Id = beneficii.Id 
LEFT JOIN totaluri ON date_principale.Id = totaluri.Id  
LEFT JOIN date_personale ON date_principale.Id = date_personale.Id  
SET date_principale.Angajat = '$upd_angajat', date_principale.Oras = '$upd_oras',
date_principale.Functie = '$upd_functie',date_personale.Varsta = '$upd_varsta',
date_personale.Vechime = '$upd_varsta',date_principale.Salariu_baza = '$upd_salariu_baza'    
 WHERE date_principale.Id=".$_GET['edit_id'];
 if(mysql_query($sql_query)or die(mysql_error()))
 {
  ?>
  <script type="text/javascript">
  alert('Data Are Updated Successfully');
  window.location.href='verificare.php';
  </script>
  <?php
 }
 else
 {
  ?>
  <script type="text/javascript">
  alert('error occured while updating data');
  </script>
  <?php
 }

}
if(isset($_POST['btn-cancel']))
{
 header("Location: index.php");
}
?>

<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="style.css" type="text/css">
        <script type="text/javascript"src="js/bootstrap.js"></script> 

<form method="post" class="well col-md-8">
    <table class="search"><tr>
        <th>Oras</th>
        <th id="angajat1">Angajat</th>
        <th>Functie</th>
        <th>Varsta</th>
        <th>Vechime</th>
        <th>Salariu baza</th>
        <th>Comision</th><th>Prima</th>
        <th>Total salariu</th>
        </tr> 
  
        
    <tr><td><input width="200"type="text" name="upd_oras" placeholder="First Name" value="<?php echo $fetched_row['Oras']; ?>" required /></td>
    

    <td><input id="angajat" type="text" name="upd_angajat" placeholder="Last Name" value="<?php echo $fetched_row['Angajat']; ?>" required /></td>
   

    <td><input type="text" name="upd_functie" placeholder="City" value="<?php echo $fetched_row['Functie']; ?>" required /></td>
   
    <td><input type="text" name="upd_varsta" placeholder="City" value="<?php echo $fetched_row['Varsta']; ?>" required /></td>
  
    <td><input type="text" name="upd_vechime" placeholder="City" value="<?php echo $fetched_row['Vechime']; ?>" required /></td>
  
    <td><input type="text" name="upd_salariu_baza" placeholder="City" value="<?php echo $fetched_row['Salariu_baza']; ?>" required /></td>
   
    <td><input type="text" name="upd_suma_comision" placeholder="City" value="<?php echo $fetched_row['Suma_comision']; ?>" required /></td>
    
    <td><input type="text" name="upd_prime" placeholder="" value="<?php echo $fetched_row['Prime']; ?>" required /></td>
   
    <td><input type="text" name="upd_total_salariu" placeholder="City" value="<?php echo $fetched_row['Total_salariu']; ?>" required /></td>
   

    
   
    </tr></table>
       <input class="btn btn-primary"  type="submit" name='btn-update' value="Modifica" OnClick="location.href = 'verificare.php';"> 
       <input class="btn btn-primary"  type="submit" value="Renunta" OnClick="location.href = 'tabel.php';">
    </form>
    </html>