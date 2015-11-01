<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="style.css" type="text/css">



        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css" />

        <!-- include the jquery library -->


        <!-- include the jquery ui library -->
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript"src="dialog_confirm.js"></script> 
        <script type="text/javascript"src="js/bootstrap.js"></script>

        <script type="text/javascript">
            //            function edt_id(id)
            //            {
            //                if (confirm('Sure to edit ?'))
            //                {
            //                    window.location.href = 'edit_data.php?edit_id=' + id;
            //                }
            //            }
            //            function delete_id(id)
            //            {
            //                if (confirm('Sure to Delete ?'))
            //                {
            //                    window.location.href = 'verificare.php?delete_id=' + id;
            //                }
            //            }

        </script>
<!--        <style>
            body {
                font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
                font-size: .8em;;
            }

            /* dialog div must be hidden */
            #basicModal{
                display:none;
            }
        </style>-->

    </head>
    <body>
        <form><input class="btn btn-primary"  type="button" value="Adauga angajat" OnClick="location.href = 'index.php';"><input class="btn btn-primary"  type="button" value="Vezi raport" OnClick="location.href = 'tabel.php';"></form>
        <form class="well col-md-8" action="verificare.php" method="POST">  
            <table class="search">
                <input type="hidden" name="id"> 
                <tr>
                    <td>Nume angajat</td>
                    <td width="200"><input type="text" name="nume_angajat"></td>
                    <td>Oras</td>
                    <td><select name="oras"> 
                            <option value=" - Alege optiunea - " > - Alege optiunea - </option>    
                            <option value="Bucuresti" >Bucuresti</option>
                            <option value="Brasov">Brasov</option> 
                            <option value="Cluj">Cluj</option>
                            <option value="Iasi">Iasi</option>
                            <option value="Timisoara">Timisoara</option>
                        </select></td>
                    <td>Functie</td>
                    <td><select name="functie">
                            <option value=" - Alege optiunea - " > - Alege optiunea - </option> 
                            <option value="Contabil" >Contabil</option>
                            <option value="Agent vanzari">Agent vanzari</option> 
                            <option value="Operator facturare">Operator facturare</option>
                            <option value="Specialist logistica">Specialist logistica</option>
                            <option value="Analist marketing">Analist marketing</option>
                            <option value="Asistent manager">Asistent manager</option>
                            <option value="Manager vanzari">Manager vanzari</option>
                            <option value="Director">Director</option>
                        </select></td>   
                    <td><input type="submit" name="cauta" value="Cauta" class="btn btn-primary"">
                    </td>    
                </tr>
            </table>           
        </form>

    </body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
include 'connect.php';

if (isset($_GET['delete_id'])) {

    $sql = mysqli_query($conn, "DELETE FROM date_principale WHERE date_principale.Id=" . $_GET['delete_id']);
    if ($sql == false) {
        die(test);
    }
}


$id = $_POST['id'];
$nume_angajat = $_POST['nume_angajat'];
$oras = $_POST['oras'];
$functie = $_POST['functie'];
?>


<table class=table-bordered cellpadding=5><tr>
        <th>Oras</th>
        <th>Angajat</th>
        <th>Functie</th>
        <th>Varsta</th>
        <th>Vechime</th>
        <th>Salariu de baza</th>
        <th>Comision</th><th>Prima</th>
        <th>Total salariu</th>
        <th>Modificare date</th>
        <th>Stergere date</th></tr>
    <?php
    $result = mysqli_query($conn, "SELECT date_principale.*,date_personale.Varsta,date_personale.Vechime,
totaluri.Suma_comision, beneficii.Prime, totaluri.Total_salariu
FROM date_principale 
LEFT JOIN beneficii ON date_principale.Id = beneficii.Id 
LEFT JOIN totaluri ON date_principale.Id = totaluri.Id  
LEFT JOIN date_personale ON date_principale.Id = date_personale.Id 
WHERE  date_principale.Angajat LIKE '%$nume_angajat%' AND date_principale.Oras LIKE '%$oras%' AND date_principale.Functie LIKE '%$functie%' LIMIT 8   ") or die(mysql_error());

    while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr id='sterge'>
            <td><?php echo $row['Oras']; ?></td>
            <td><?php echo $row['Angajat']; ?> </td>
            <td><?php echo $row['Functie']; ?> </td>
            <td><?php echo $row['Varsta']; ?>&nbsp;ani </td>    
            <td><?php echo $row['Vechime']; ?>&nbsp;ani </td>    
            <td><?php echo $row['Salariu_baza']; ?> </td> 
            <td><?php echo $row['Suma_comision']; ?> </td>
            <td><?php echo $row['Prime']; ?> </td>  
            <td><?php echo $row['Total_salariu']; ?>&nbsp;lei </td>  
        <input type='hidden' name='id'> 
        <td><a href="edit_data.php?edit_id=<?php echo $row[0]; ?>"><input type='submit' name='edit' value='Modifica' id='modifica' class='btn btn-primary' ></a> </td> 
        <td><a  class='sterge' href="javascript:delete_id(<?php echo $row[0]; ?>)"><input type='submit' name='sterge' value='Sterge'class='btn btn-primary' ></a> </td> 

    </tr>
    <?php
}
mysqli_close($conn);
?>

</table>


