<?php
ob_start();
include ('DBConnect.php');
?>
<?php
session_start();
if(($_SESSION['user']!="") && (($_SESSION['category']=="senior" && $_SESSION['role']=="Regular") || ($_SESSION['category']=="junior") && $_SESSION['role']=="Regular" )
        || ($_SESSION['user']!="") && (($_SESSION['category']=="senior" && $_SESSION['role']=="Cashier") || ($_SESSION['category']=="junior") && $_SESSION['role']=="Cashier" )
        || (($_SESSION['user']!="") && (($_SESSION['category']=="senior" && $_SESSION['role']=="HRM") || ($_SESSION['category']=="junior") && $_SESSION['role']=="HRM" )))
{
$staff_id=$_GET['id'];
$CurrentDate=  date('20y:m:d');
$CurrentMonth=  date('M');
$CurrentYear=date('Y');
$viewStf=  mysql_query("SELECT * FROM staff WHERE Staff_ID='$staff_id'");
$StfReslt=  mysql_fetch_array($viewStf);
$surname=$StfReslt['Surname'];
$firstname=$StfReslt['FirstName'];
$othername=$StfReslt['OtherName'];
//
$check=  mysql_query("SELECT * FROM attendancereq WHERE Staff_ID='$staff_id' AND Date='$CurrentDate'");
//$checkReslt=  mysql_fetch_array($check);
if(mysql_num_rows($check)<1)
    {
  //  sesial increment
 $serial=  mysql_query("select * from attendancereq");
    $count=  mysql_fetch_array($serial);
    $sn1=mysql_num_rows($serial);
    $sn=$sn1+1;
 //insert attendance
    $insertAtt="INSERT into attendancereq values ('$sn','$staff_id','$surname','$firstname','$othername','$CurrentDate','$CurrentMonth','$CurrentYear')";
     $insertReslt=  mysql_query($insertAtt);
     if($insertReslt && $_SESSION['role']=="Cashier")
     {
           header("Location:cashierHome.php");
     }
     else if($insertReslt && $_SESSION['role']=="HRM")
     {
           header("Location:hrmHome.php");   
     }
     else if($insertReslt && $_SESSION['role']=="Regular")
     {
           header("Location:staffHome.php");
     }
 else {
         echo 'error inserting attendance'.  mysql_error();    
}
}
else
{
   echo "<script>alert('Cannot Mark Attendance more than once a Day.Click back arrow on the top-left corner of Your browser to return to previous page')</script>";
   // header("Location:staffHome.php");
  // echo "<script>alert('Cannot Mark Attendance more than once a Day')</script>";
}
}
else{
    echo 'erro '.  mysql_error();
}
?>

