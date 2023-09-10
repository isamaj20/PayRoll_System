<?php
ob_start();
include ('DBConnect.php');
?>
<?php
$staff_id=$_GET['id'];
$date=  date('Y:m:d');
$month=  date('M');
$year=date('Y');
//view Attendance
$viewAtt=  mysql_query("SELECT * FROM attendance WHERE Staff_ID='$staff_id' && Month='$month' && Year='$year'");
$AttReslt=  mysql_fetch_array($viewAtt);
$AttTotal= mysql_num_rows($viewAtt);
//view salary
$viewSal=  mysql_query("SELECT * FROM salary WHERE Staff_ID='$staff_id'");
$SalReslt=  mysql_fetch_array($viewSal);
$salary=$SalReslt['Amount'];
//view staff
$viewStf=  mysql_query("SELECT * FROM staff WHERE Staff_ID='$staff_id'");
$StfReslt=  mysql_fetch_array($viewStf);
//view allowance
//$viewAll=  mysql_query("SELECT * FROM allowance WHERE Staff_ID='$staff_id'");
//$AllReslt=  mysql_fetch_array($viewAll);
echo $date;
 $cloth=0;
 $house=0;
 $medical=0;
 $transport=0;
 $grossPay=0;
 $tax=0;
 $deductn=0;
  $netPay=0;
if($AttTotal>11 && $AttTotal<22)
{
    $salary=($salary/2);
}
elseif ($AttTotal>=22) 
    {
$salary=$salary;
}
elseif ($AttTotal<11)
    {
$salary=0;
}
else{
  $salary=0;  
}
if($StfReslt['Category']=="senior")
 {
 $cloth=(5/100)*$salary;
 $house=(10/100)*$salary;
 $medical=(10/100)*$salary;
 $transport=(10/100)*$salary;
 $grossPay=$salary+$medical+$cloth+$house+$transport;
 $allow=$medical+$cloth+$house+$transport;
  $tax=(10/100)*$salary;
  $deductn=$tax;
  $netPay=$grossPay-$deductn;
  //update SN
   $serial=  mysql_query("select * from payhistory");
    $count=  mysql_fetch_array($serial);
    $sn1=mysql_num_rows($serial);
    $sn=$sn1+1;
  //Insert Pay record To Pay History
  $insertPay="INSERT into payhistory values ('$sn','$staff_id','$AttTotal','$allow','$tax','$grossPay','$netPay','$date','$month','$year')";
     $insertPayReslt=  mysql_query($insertPay);
     if($insertPayReslt)
     {
         $del=  mysql_query("DELETE FROM payrequest WHERE Staff_ID='$staff_id' AND Month='$month' AND Year='$year'");
         if($del){
            header("Location:salaReq.php");   
         }
        else{
            // header("Location:salaReq.php");
            echo 'error '.  mysql_error();
        }
     }
     else
     {
         //echo "Error ".mysql_error();
        header("Location:payStaff.php"); 
     }
 }
 else{
     $medical=(10/100)*$salary;
     $transport=(10/100)*$salary;
     $tax=(5/100)*$salary;
     $cloth=0;
    $house=0;
      $grossPay=$salary+$medical+$transport;
      $allow=$medical+$transport;
      $deductn=$tax;
  $netPay=$grossPay-$deductn; 
  //update SN
   $serial=  mysql_query("select * from payhistory");
    $count=  mysql_fetch_array($serial);
    $sn1=mysql_num_rows($serial);
    $sn=$sn1+1;
  //Insert Pay record To Pay History
  $insertPay="INSERT into staff values ('$sn','$staff_id','$AttTotal','$allow','$tax','$grossPay','$netPay','$date','$month','$year')";
     $insertPayReslt=  mysql_query($insertPay);
     if($insertPayReslt)
     {
         header("Location:employerHome.php"); 
     }
     else
     {
         header("Location:payStaff.php"); 
     }
 }
?>