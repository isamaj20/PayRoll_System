<?php
ob_start();
include ('DBConnect.php');
?>
<?php
session_start();
if(($_SESSION['user']!="") && ($_SESSION['role']=="employer"))
{
$staff_id=$_GET['id'];
$date=  date('D:m:Y');
$month=  date('M');
$year=date('Y');
?>
<html>
    <head>
        <title>PayRoll | View Staff Attendance</title>
    </head>
    <body>
        <table border="1">
            <tr>
                <th>
                  <?php                    echo $date?>;
                </th>
            </tr>
            <tr>
                <th colspan="9">
                  Attendance For the Month:  <?php echo $month." ".$year?>
                </th>
            </tr>
            <tr>
                <th>SN</th>
                <th>Staff ID</th>
                <th>Surname</th>
                <th>First Name</th>
                <th>Other Name</th>
                <th>Date</th>
                <th>Month</th>
                <th>Year</th>
                <th>No. Days Present</th>
            </tr>
            <?php
//$view=  mysql_query("SELECT * FROM staff");
//view Attendance
            $id="";
$viewAtt=  mysql_query("SELECT * FROM attendance WHERE Staff_ID='$staff_id' && Month='$month' && Year='$year'");
$AttTotal= mysql_num_rows($viewAtt);
$k=0;
while ($AttReslt=  mysql_fetch_array($viewAtt))
{
  $k++; 
?>
            <tr>
                <td>
                    <?php echo $k ?>
                </td>
                <td>
                    <?php echo $AttReslt['Staff_ID']; ?>
                </td> 
               <td>
                    <?php echo $AttReslt['Surname']; ?>
                </td> 
                <td>
                    <?php echo $AttReslt['FirstName']; ?>
                </td>
                <td>
                     <?php echo $AttReslt['OtherName']; ?>
                </td>
                <td>
                    <?php echo $AttReslt['Date']; ?>
                </td>
                <td>
                     <?php echo $AttReslt['Month']; ?>
                </td>
                <td>
                     <?php echo $AttReslt['Year']; ?>
                </td>
                <td>
                     <?php echo $AttTotal; ?>
                </td>
<!--                <td>
                    <a href="PayHistory.php?id=<?php// echo $viewReslt['Staff_ID'] ?>">Payment History</a>
                </td>
                <td>
                    <a href="Attendance.php?id=<?php //echo $viewReslt['Staff_ID'] ?>">Attendance</a>
                </td>-->
            </tr>
            <?php
            $id=$AttReslt['Staff_ID'];
}
?>
            <tr>
                <th colspan="9">
                    <a href="payStaff.php?id=<?php echo $id ?>">Pay Salary</a>
                </th>
            </tr>
        </table>
    </body>
</html>
<?php
//$_SESSION['user']=$usern;
}
else{
    header("Location:Home.php");
}
?>

