<?php
ob_start();
include ('DBConnect.php');
?>
<?php
session_start();
if(($_SESSION['user']!="") && ($_SESSION['role']=="employer"))
{
//$staff_id=$_GET['id'];
$date=  date('Y:m:d');
$day=date('d');
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
                <th colspan="9">
                  Attendance For the Day:  <?php echo $day." ".$month." ".$year?>
                </th>
            </tr>
            <tr>
                <th>SN</th>
                <th>Staff ID</th>
                <th>Surname</th>
                <th>First Name</th>
                <th>Other Name</th>
                <th>Request Date</th>
                <th>Month</th>
                <th>Year</th>
                <th>Attendance</th>
            </tr>
            <?php
//$view=  mysql_query("SELECT * FROM staff");
//view Attendance
            $id="";
$viewAtt=  mysql_query("SELECT * FROM attendancereq WHERE Date='$date'");
//$AttTotal= mysql_num_rows($viewAtt);
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
                    <a href="Attendance.php?id=<?php echo $AttReslt['Staff_ID'] ?>">Approve Attendance</a>
              </td>
<!--                  
                <td>
                    <a href="Attendance.php?id=<?php //echo $viewReslt['Staff_ID'] ?>">Attendance</a>
                </td>-->
            </tr>
            <?php
            $id=$AttReslt['Staff_ID'];
}
?>
<!--            <tr>
                <th colspan="9">
                    <a href="payStaff.php?id=<?php echo $id ?>">Pay Salary</a>
                </th>
            </tr>-->
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

