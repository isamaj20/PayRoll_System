<?php
//$host="localhost";
//$user="root";
//$password="adeyi";
//$dbName="payroll";
//mysql_connect($host,$user,$password);
//mysql_select_db($dbName);
$host="localhost";
$user="root";
$password="adeyi";
$dbName="payroll";
$con=mysqli_connect($host,$user,$password);
mysqli_select_db($con,$dbName);