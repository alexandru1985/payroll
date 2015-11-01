<!DOCTYPE html5>
<html>
      <head>
          <title></title>
          <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
          <link rel="stylesheet" href="style.css" type="text/css">
            <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
          <script type="text/javascript"src="js/bootstrap.js"> </script> 
          <script type="text/javascript"src="javascript.js"> </script> 

          
          
          
      </head>
    <body>
     <div id="container">
    <form><input class="btn btn-primary" type="button" value="Vezi raport" OnClick="location.href='tabel.php';"><input class="btn btn-primary" type="button" value="Cauta angajat" OnClick="location.href='verificare.php';"></form>    
     <form name = "form"action="index.php" method="POST" class ="well col-md-4" onsubmit="return validateForm()">  
     <table class="tabel"> 
         <input type="hidden" name="id"> 
         <tr>
              <td  width="135">Nume angajat</td>
              <td width="250"><input class="span3" type="text" name="nume_angajat" ></td>
         </tr>
            <tr>
               <td>Oras</td>
               <td><select name="oras">
                   <option value="Bucuresti" >Bucuresti</option>
                   <option value="Brasov">Brasov</option> 
                   <option value="Cluj">Cluj</option>
                   <option value="Iasi">Iasi</option>
                   <option value="Timisoara">Timisoara</option>
                  </select></td>
            </tr>
         <tr>
               <td>Functie</td>
               <td><select name="functie">
                   <option value="Contabil" >Contabil</option>
                   <option value="Agent vanzari">Agent vanzari</option> 
                   <option value="Operator facturare">Operator facturare</option>
                   <option value="Specialist logistica">Specialist logistica</option>
                   <option value="Analist marketing">Analist marketing</option>
                   <option value="Asistent manager">Asistent manager</option>
                   <option value="Manager vanzari">Manager vanzari</option>
                   <option value="Director">Director</option>
                  </select></td>
            </tr>
          <tr>
              <td>Varsta</td>
              <td ><input type="text" name="varsta"style="width:35px" > ani &nbsp;&nbsp;&nbsp;&nbsp;Vechime&nbsp;&nbsp;<input type="text" name="vechime"style="width:35px" > ani</td> 
            
         </tr>
           <tr>
              <td>Salariu de baza</td>
              <td ><input type="text" name="salariu"style="width:70px" > lei &nbsp;&nbsp;&nbsp;&nbsp; Prima&nbsp;&nbsp<input type="text" name="prima"style="width:70px" > Impozit&nbsp;&nbsp;<input type="text" name="impozit"style="width:35px" value> %</td> 
            
         </tr>
         <tr>
              <td>Total vanzari</td>
              <td ><input type="text" name="total_vanzari"style="width:70px" > lei &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Comision vanzari&nbsp;&nbsp;<input type="text" name="comision"style="width:35px" > %</td> 
            
         </tr>
         <tr>
           <td></td>
           <td><input type="submit" name="adauga" value="Adauga" class="btn btn-primary">
           </td>
           </tr>
         
     </table>    
     </form>   
        
        
        
        
        
        
        
       </div> 
        
    </body>
</html>
<?php
$id =$_POST['id'];
$nume_angajat =$_POST['nume_angajat'];
$oras = $_POST['oras'];
$functie = $_POST['functie'];
$varsta = $_POST['varsta'];
$vechime = $_POST['vechime'];
$salariu = $_POST['salariu'];
$impozit=$_POST['impozit'];
$prima = $_POST['prima'];
$comision=$_POST['comision'];
$total_vanzari=$_POST['total_vanzari'];
$adauga=$_POST['adauga'];
$connect = new mysqli('localhost','root', '', 'payroll');

// verifica conexiunea
if (mysqli_connect_errno()) {
  exit('Connect failed: '. mysqli_connect_error());
}
if(!empty($_POST['nume_angajat'])||!empty($_POST['salariu'])&&!isset($_POST['adauga'])){
// interogare sql cu CREATE DATABASE
$sql =mysqli_query($connect,"INSERT INTO date_principale (Oras ,Angajat, Functie, Salariu_baza) VALUES ('$oras','$nume_angajat',"
    . "'$functie','$salariu')");
$sql1=mysqli_query($connect,"INSERT INTO date_personale (Angajat ,Varsta, Vechime) VALUES ('$nume_angajat',"
    . "'$varsta','$vechime')");
$sql2=mysqli_query($connect,"INSERT INTO totaluri (Angajat, Impozit_salariu_baza, Total_vanzari) VALUES ('$nume_angajat','$impozit','$total_vanzari')");
$sql3=mysqli_query($connect,"INSERT INTO beneficii (Angajat, Comision, Prime) VALUES ('$nume_angajat','$comision','$prima')");
$sql4=mysqli_query($connect,"UPDATE totaluri
          LEFT JOIN date_principale ON date_principale.Id = totaluri.Id
          SET Suma_impozit = (date_principale.Salariu_baza*totaluri.Impozit_salariu_baza)/100");  
$sql5=mysqli_query($connect,"UPDATE totaluri
          LEFT JOIN beneficii ON beneficii.Id = totaluri.Id
          SET Suma_comision = (beneficii.Comision*totaluri.Total_vanzari)/100"); 
$sql6=mysqli_query($connect," UPDATE totaluri
          LEFT JOIN beneficii ON beneficii.Id = totaluri.Id
          LEFT JOIN date_principale ON date_principale.Id = totaluri.Id
SET Total_salariu =(date_principale.Salariu_baza -totaluri.Suma_impozit) + beneficii.Prime + totaluri.Suma_comision    ");}

else 
    {echo "";} 
    
 // executa interogarea $sql pe server pentru a crea baza de date   
if ($sql&&$sql1 === TRUE) {
  echo '<div id=mesaj>';  
  echo 'Datele angajatului au fost adaugate!';
  echo '</div>';  
}


/* SELECT date_principale.Salariu_baza, beneficii.Prime, SUM( date_principale.Salariu_baza + beneficii.Prime ) AS Total
FROM date_principale
LEFT JOIN beneficii ON date_principale.Id = beneficii.Id GROUP BY date_principale.Id   */

/*       INSERT INTO totaluri(Total_salariu) SELECT SUM( date_principale.Salariu_baza + beneficii.Prime ) AS Total
FROM date_principale
LEFT JOIN beneficii ON date_principale.Id = beneficii.Id ORDER BY date_principale.Id                */

/*     DELETE FROM totaluri Where Id Between 144 AND 300
 * 
 *      
 UPDATE totaluri SET Total_salariu=NULL
          */


/*        UPDATE totaluri
          LEFT JOIN beneficii ON beneficii.Id = totaluri.Id
          LEFT JOIN date_principale ON date_principale.Id = totaluri.Id
          SET Total_salariu =(date_principale.Salariu_baza -totaluri.Suma_impozit) + beneficii.Prime + totaluri.Suma_comision                 */

  /* UPDATE totaluri
          LEFT JOIN date_principale ON date_principale.Id = totaluri.Id
          SET Suma_impozit = (date_principale.Salariu_baza*totaluri.Impozit_salariu_baza)/100   */


 /*  UPDATE totaluri
          LEFT JOIN beneficii ON beneficii.Id = totaluri.Id
          SET Suma_comision = (beneficii.Comision*totaluri.Total_vanzari)/100 */ 


/* SELECT totaluri.Total_salariu, date_principale.Functie, SUM( Total_salariu ) 
FROM totaluri
LEFT JOIN date_principale ON date_principale.Id = totaluri.Id
WHERE Functie LIKE  '%Director%'
OR Functie LIKE  '%Agent vanzari%'  */

/*SELECT date_principale.Oras, date_principale.Angajat, date_principale.Functie, date_principale.Salariu_baza, totaluri.Suma_comision, beneficii.Prime, totaluri.Total_salariu
FROM date_principale
LEFT JOIN beneficii ON date_principale.Id = beneficii.Id
LEFT JOIN totaluri ON date_principale.Id = beneficii.Id
GROUP BY date_principale.Id */


/*SELECT  * FROM date_principale WHERE  Oras LIKE '%$oras%' AND Functie LIKE '%$functie%' AND  Angajat LIKE '%$nume_angajat%'*/

/*SELECT ID,CARTE FROM `autori` USE INDEX (CARTE_ID)*/
$connect->close();
?>

