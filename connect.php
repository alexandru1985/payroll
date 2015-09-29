<?php
$host = "localhost";
$user = "root";
$password = "";
$datbase = "payroll";
mysql_connect($host,$user,$password);
mysql_select_db($datbase)or die(mysql_error());