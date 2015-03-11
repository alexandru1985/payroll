<?php
 mysql_connect('localhost','root', '');
 mysql_select_db('payroll');



?> 
<html>
      <head>
          <title></title>
            <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
          <link rel="stylesheet" href="style.css" type="text/css">
          <script type="text/javascript"src="js/bootstrap.js"> </script> 
      </head>
<form><input class="btn btn-primary"  type="button" value="Adauga angajat" OnClick="location.href='index.php';"><input class="btn btn-primary"  type="button" value="Cauta angajat" OnClick="location.href='verificare.php';"></form>    
   <table class="table-bordered" >
             <tr>
                  <th>Departament</th>
                  <th>Numar angajati</th>
           <th class="departament">Total salarii / departament</th>
             </tr>
                 <tr>
                    <td width="135">Vanzari</td>
                
                    <td width="135" ><?php
$result6 = mysql_query("SELECT  COUNT(Functie)  FROM date_principale WHERE Functie LIKE '%Agent vanzari%'") or die(mysql_error());  
while($row6= mysql_fetch_array($result6))  
{  

 echo $row6['COUNT(Functie)'];  

}?></td>
       <td><?php
$result8 = mysql_query("SELECT totaluri.Total_salariu, date_principale.Functie, SUM( Total_salariu ) 
FROM totaluri
LEFT JOIN date_principale ON date_principale.Id = totaluri.Id
WHERE Functie LIKE  '%Agent vanzari%'") or die(mysql_error());  
while($row8= mysql_fetch_array($result8))  
{  

 echo $row8['SUM( Total_salariu )']. " " ."lei";  

}?>  </td>
                   
                </tr>
                 <tr>
                     <td>Administrativ</td>
                     <td><?php
$result5 = mysql_query("SELECT  COUNT(Functie)  FROM date_principale WHERE Functie LIKE '%Operator facturare%'OR Functie LIKE '%Contabil%'") or die(mysql_error());  
while($row5= mysql_fetch_array($result5))  
{  

 echo $row5['COUNT(Functie)'];  

}?></td>
                 <td><?php
$result9 = mysql_query("SELECT totaluri.Total_salariu, date_principale.Functie, SUM( Total_salariu ) 
FROM totaluri
LEFT JOIN date_principale ON date_principale.Id = totaluri.Id
WHERE Functie LIKE  '%Contabil%'
OR Functie LIKE  '%Operator facturare%'") or die(mysql_error());  
while($row9= mysql_fetch_array($result9))  
{  

 echo $row9['SUM( Total_salariu )']. " " ."lei";  

}?></td>
                  
                 </tr>
               <tr>
                    <td>Logistica</td>
                    <td><?php
$result5 = mysql_query("SELECT  COUNT(Functie)  FROM date_principale WHERE Functie LIKE '%Specialist logistica%'") or die(mysql_error());  
while($row5= mysql_fetch_array($result5))  
{  

 echo $row5['COUNT(Functie)'];  

}?></td>
          <td><?php
$result10 = mysql_query("SELECT totaluri.Total_salariu, date_principale.Functie, SUM( Total_salariu ) 
FROM totaluri
LEFT JOIN date_principale ON date_principale.Id = totaluri.Id
WHERE Functie LIKE  '%Specialist logistica%'") or die(mysql_error());  
while($row10= mysql_fetch_array($result10))  
{  

 echo $row10['SUM( Total_salariu )']. " " ."lei";  

}?></td>
               </tr>
               <tr>
                   <td>Marketing</td>
                    <td><?php
$result5 = mysql_query("SELECT  COUNT(Functie)  FROM date_principale WHERE Functie LIKE '%Analist marketing%'") or die(mysql_error());  
while($row5= mysql_fetch_array($result5))  
{  

 echo $row5['COUNT(Functie)'];  

}?></td>
              <td><?php
$result11 = mysql_query("SELECT totaluri.Total_salariu, date_principale.Functie, SUM( Total_salariu ) 
FROM totaluri
LEFT JOIN date_principale ON date_principale.Id = totaluri.Id
WHERE Functie LIKE  '%Analist marketing%'") or die(mysql_error());  
while($row11= mysql_fetch_array($result11))  
{  

 echo $row11['SUM( Total_salariu )']. " " ."lei";  

}?></td>
               </tr>
                  <tr>
                   <td>Management</td>
                    <td><?php
$result4 = mysql_query("SELECT  COUNT(Functie)  FROM date_principale WHERE Functie LIKE '%Manager vanzari%' OR Functie LIKE '%Director%'OR Functie LIKE '%Asistent manager%'") or die(mysql_error());  
while($row4= mysql_fetch_array($result4))  
{  

 echo $row4['COUNT(Functie)'];  

}?></td>
              <td><?php
$result12 = mysql_query("SELECT totaluri.Total_salariu, date_principale.Functie, SUM( Total_salariu ) 
FROM totaluri
LEFT JOIN date_principale ON date_principale.Id = totaluri.Id
WHERE  Functie LIKE '%Manager vanzari%' OR Functie LIKE '%Director%'OR Functie LIKE '%Asistent manager%'") or die(mysql_error());  
while($row12= mysql_fetch_array($result12))  
{  

 echo $row12['SUM( Total_salariu )']. " " ."lei";  

}?></td>
               </tr>
                    <tr>
                    <td width="100" ><b>Total angajati</b></td>
                
                    <td width="120" ><?php
$result2 = mysql_query("SELECT  COUNT(Angajat)  FROM date_principale") or die(mysql_error());  
while($row2= mysql_fetch_array($result2))  
{  

 echo $row2['COUNT(Angajat)'];  

}?>  </td>

                   
                </tr>
                       <tr>
                     <td><b>Total impozit</b></td>
                     <td><?php
$result3 = mysql_query("SELECT  SUM(Suma_impozit)  FROM totaluri") or die(mysql_error());  
while($row3= mysql_fetch_array($result3))  
{  

 echo $row3['SUM(Suma_impozit)']. " " ."lei";  

}?> </td>
               
                  
                 </tr>
                
                   <tr>
                     <td><b>Total comision</b></td>
                     <td><?php
$result1 = mysql_query("SELECT  SUM(Suma_comision)  FROM totaluri") or die(mysql_error());  
while($row1= mysql_fetch_array($result1))  
{  

 echo $row1['SUM(Suma_comision)']. " " ."lei";  

}?> </td>
               
                  
                 </tr>
                     <tr>
                     <td><b>Total salarii</b></td>
                     <td><?php
$result = mysql_query("SELECT  SUM(Total_salariu)  FROM totaluri") or die(mysql_error());  
while($row= mysql_fetch_array($result))  
{  

 echo $row['SUM(Total_salariu)']. " " ."lei";  

}?>  
</td>
               
                  
                 </tr>
                
        </table> 
    
</html>
     

	


