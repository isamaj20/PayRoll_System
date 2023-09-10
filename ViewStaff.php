<?php
include ('DBConnect.php');
?>
<?php
session_start();
if(($_SESSION['user']!="") && ($_SESSION['role']=="employer"))
{
?>
<html>
    <head>
        <title>PayRoll | View All Staff</title>
    </head>
    <body>
        <table border="1">
            <tr>
                <th>SN</th>
                <th>Staff ID</th>
                <th>Surname</th>
                <th>First Name</th>
                <th>Gender</th>
                <th>Telephone</th>
                <th>Category</th>
                <th colspan="3">Others</th>
            </tr>
            <?php
$view=  mysql_query("SELECT * FROM staff");
$k=0;
while ($viewReslt=  mysql_fetch_array($view))
{
  $k++; 
?>
            <tr>
                <td>
                    <?php echo $k ?>
                </td>
                <td>
                    <?php echo $viewReslt['Staff_ID']; ?>
                </td> 
               <td>
                    <?php echo $viewReslt['Surname']; ?>
                </td> 
                <td>
                    <?php echo $viewReslt['FirstName']; ?>
                </td>
                <td>
                    <?php echo $viewReslt['Gender']; ?>
                </td>
                <td>
                    <?php echo $viewReslt['PhoneNumber']; ?>
                </td>
                <td>
                    <?php echo $viewReslt['Category']; ?>
                </td>
                <td>
                    <a href="payStaff.php?id=<?php echo $viewReslt['Staff_ID'] ?>">Pay Salary</a>
                </td>
                <td>
                    <a href="PayHistory.php?id=<?php echo $viewReslt['Staff_ID'] ?>">Payment History</a>
                </td>
                <td>
                    <a href="viewStaffAttendance.php?id=<?php echo $viewReslt['Staff_ID'] ?>">Attendance</a>
                </td>
            </tr>
            <?php
}
?>
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
