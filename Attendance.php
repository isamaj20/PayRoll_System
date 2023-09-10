<?php
ob_start();
include ('DBConnect.php');
 ?>
<?php
 session_start();
if((($_SESSION['user']!="") && ($_SESSION['category']=="employer") &&  ($_SESSION['role']=="Admin")) || 
  (($_SESSION['user']!="") && (($_SESSION['category']=="senior" && $_SESSION['role']=="HRM") || ($_SESSION['category']=="junior") && $_SESSION['role']=="HRM" )))
{
$staff_id=$_GET['id'];
$CurrentDate=  date('Y:m:d');
$CurrentMonth=  date('M');
$CurrentYear=date('Y');
$viewStf=  mysql_query("SELECT * FROM staff WHERE Staff_ID='$staff_id'");
$StfReslt=  mysql_fetch_array($viewStf);
$surname=$StfReslt['Surname'];
$firstname=$StfReslt['FirstName'];
$othername=$StfReslt['OtherName'];
//
$check=  mysql_query("SELECT * FROM attendance WHERE Staff_ID='$staff_id' AND Date='$CurrentDate'");
//$checkReslt=  mysql_fetch_array($check);
if(mysql_num_rows($check)<1)
    {
//sesial increment
 $serial=  mysql_query("select * from attendance");
    //$count=  mysql_fetch_array($serial);
    $sn1=mysql_num_rows($serial);
    $sn=$sn1+1;
 //insert attendance
    $insertAtt="INSERT into attendance values ('$sn','$staff_id','$surname','$firstname','$othername','$CurrentDate','$CurrentMonth','$CurrentYear')";
     $insertReslt=  mysql_query($insertAtt);
     if($insertReslt)
     {
        //
         $del=  mysql_query("DELETE FROM attendancereq WHERE Staff_ID='$staff_id' AND Date='$CurrentDate' AND Year='$CurrentYear'");
         if($del && $_SESSION['role']=="employer"){
           header("Location:employerHome.php");   
         }
         else if($del && $_SESSION['role']=="HRM")
         {
           header("Location:hrmHome.php");   
         }
        else{
            // header("Location:salaReq.php");
            echo 'error '.  mysql_error();
        }
     }
 else {
         echo 'error inserting attendance'.  mysql_error();    
      }
}
else
{
    echo "<script>alert('Cannot Approve Attendance twice a Day. Click back arrow on the top-left corner of Your browser to return to previous page')</script>";
    //header("Location:employerHome.php");
}
//echo 'current date '.$CurrentDate.'   DtabaseDate'.$dbDate;
}

?>