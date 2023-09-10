<?php
include ('DBConnect.php');
?>
<?php
$staff_id=$_GET['id'];
$date=  date('d:m:Y');
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
  $tax=(10/100)*$salary;
  $deductn=$tax;
  $netPay=$grossPay-$deductn;
  $monthly=$salary;
  $annual=$netPay*12;
  $quarterly=$annual/4;
 }
 else{
     $medical=(10/100)*$salary;
     $transport=(10/100)*$salary;
     $tax=(5/100)*$salary;
     $cloth=0;
    $house=0;
      $grossPay=$salary+$medical+$transport;
      $deductn=$tax;
  $netPay=$grossPay-$deductn;
  $monthly=$salary;
  $annual=$netPay*12;
  $quarterly=$annual/4;
      
 }
?>
<html>
    <head>
        <title>Slip</title>
    </head>
    <body onload="window.print();">
           <table border="1" cellpadding="5" style="width: 80%; height: 80%; margin: 0 auto;">
                <tr>
                    <th  colspan="6" style=" background-color: #663300;">
                        STAFF PAY-SLIP
                    </th>
                </tr>
            <tr>
                <th>
                   Staff Names 
                </th>
                <th>
                   ID 
                </th>
                <th>
                  Pay Date 
                </th>
                <th>
                    Month
                </th>
                <th>
                    Year
                </th>
                <th>
                   No. of days at Work 
                </th>
            </tr>
            <tr>
                <td>
              <?php echo $AttReslt['Surname']." ".$AttReslt['OtherName']." ".$AttReslt['FirstName'] ?> 
                </td>
                <td>
              <?php echo $staff_id ?> 
                </td>
                <td>
              <?php echo $date ?> 
                </td>
                <td>
              <?php echo $month ?> 
                </td>
                <td>
              <?php echo $year ?> 
                </td>
                <td>
              <?php echo $AttTotal ?> 
                </td>
            </tr>
            <tr>
                <th>
                    Earnings
                </th>
                <th>
                    Amount
                </th>
                <th>
                    Deductions
                </th>
                <th>
                    Amount
                </th>
            </tr>
            <tr>
                <td>
                    Gross Salary
                </td>
                 <td>
                 <?php echo "   N".$salary ?> 
                </td>
                <td>
                    Tax
                </td>
                <td>
                  <?php echo "   N".$tax ?> 
                </td>
            </tr>
            <tr>
                <td>
                    Medical Allowance
                </td>
                <td>
                   <?php echo "   N".$medical ?> 
                </td>
            </tr>
            <tr>
                <td>
                    Transport Allowance
                </td>
                <td>
                    <?php echo "   N".$transport ?> 
                </td>
            </tr>
            <tr>
                <td>
                    House Allowance
                </td>
                <td>
                   <?php echo "   N".$house ?> 
                </td>
            </tr>
            <tr>
                <td>
                    Cloth Allowance
                </td>
                <td>
                    <?php echo "   N".$cloth ?> 
                </td>
            </tr>
            <tr>
                <th>
                    Gross Pay
                </th>
                <td>
                     <?php echo "   N".$grossPay ?>
                </td>
                <th>
                    Total Deductions
                </th>
                <td>
                     <?php echo "   N".$deductn ?>
                </td>
            </tr>
            <tr>
                <th colspan="6" style=" background-color: whitesmoke;">
                    Net Pay: <?php echo"   N".$netPay ?>
                </th>
            </tr>
            <tr>
                <th colspan="2"  style="background-color: whitesmoke;">
                   Quarterly : <?php  echo"  N".$quarterly ?> 
                </th>
                <th colspan="2"  style="background-color: whitesmoke;">
                   Monthly : <?php  echo"  N".$monthly ?> 
                </th>
            
                <th colspan="2"  style="background-color: whitesmoke;">
                   Annual : <?php  echo"  N".$annual ?> 
                </th>
            </tr>
            <tr>
                <th colspan="6" align="left" style=" background-color: whitesmoke;">
                    Comments:
                </th>
            </tr>
            <tr>
                <th colspan="3" align="left" style=" background-color: whitesmoke;">
                    Employee's Signature:
                </th>
                <th colspan="3" align="left" style=" background-color: whitesmoke;">
                    Accountant's Signature:
                </th>
            </tr>
        </table>
</body>
</html>
