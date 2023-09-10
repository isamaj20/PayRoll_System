<?php
include ('DBConnect.php');
?>
<?php
session_start();
if(($_SESSION['user']!="") && ($_SESSION['category']=="employer") &&  ($_SESSION['role']=="Admin"))
{
    $msg="";
    $ID=$_SESSION['user'];
    $viewPass=  mysql_query("SELECT * FROM user WHERE  Username='$ID'");
 $PassRslt=  mysql_fetch_array($viewPass);
 //$pas=$PassRslt['Password'];
            $day=date('d');
             $dy=  date('D');
             $month=  date('M');
             $year=date('Y');
//
                    $sn=$_GET['sn'];
                    if($sn!="")
                    {
                $DelMsg=  mysql_query("DELETE FROM contact_us WHERE SN='$sn'");
                if($DelMsg){
                     header("Location:suggestion.php");
                      }
                }
             else {
                echo "<script>alert('Please Select Message To Delete.')</script>";
                  }
          }
else{
     header("Location:Home.php");
}
?>
