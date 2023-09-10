<?php
include ('DBConnect.php');
ob_start();
?>
<?php
session_start();
if(($_SESSION['user']!="") && (($_SESSION['category']=="senior" && $_SESSION['role']=="Cashier") || ($_SESSION['category']=="junior") && $_SESSION['role']=="Cashier" ))
{
    $ID=$_SESSION['user'];
  $viewPass=  mysql_query("SELECT * FROM user WHERE  Username='$ID'");
 $PassRslt=  mysql_fetch_array($viewPass);
 $pas=$PassRslt['Password'];
 //
$staff_id=$_GET['id'];
$date=  date('d:m:Y');
//$CurrentMonth=  date('M');
//$CurrentYear=date('Y');
$month=  date('M');
$year=date('Y');
//view Attendance
?>
<html>
    <head>
        <link href="css/report.css" type="text/css" rel="stylesheet">
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <title> Staff Payment</title>
    </head>
    /<style>
        #pass{
    visibility: hidden;
}
#hidePass{
    visibility: hidden;
}
    </style>
        </head>
    <body bgcolor="gainsboro">
        <div class="head">
            <div class="logoHolder">
                <div class="logo" style="background-image: url(images/logoBrunNET.png); background-repeat:  no-repeat; background-size: 100% 100%;">
                    
                </div>
            </div>
            <div class="middleHead">
                <div class="signupHolder">
                <div class="signup">
                   PayRoll System
                </div>
            </div> 
                <div class="titleHead">
                  BrunNET Technology
                </div>
                <div class="smallTitle">
                    ...Network Without Limit
                </div>
            </div>
            <div class="logoutHolder">
                 <div class="logout">
                      <br>
                  CURRENT USER:
                  <br>
                  USER ID: &nbsp;&nbsp;&nbsp;<?php echo $ID; ?>
                  <br>
                  <input onclick="document.getElementById('pass').style.visibility='visible', document.getElementById('hidePass').style.visibility='visible'; " type="button" value="Show Password">
                  <div id="pass"> <?php echo"PASSWORD: ".$pas  ?>
                  </div><input id="hidePass" onclick="document.getElementById('pass').style.visibility='hidden', document.getElementById('hidePass').style.visibility='hidden';" type="button" value="Hide Password">
                  <br>
      <script language="JavaScript" type="text/javascript">
          var date=new Date();
          var time=date.toLocaleTimeString();
          document.write("Time :"+time);
      </script>
      <br>
                  <?php
                  if($_POST['logout']!="")
                {
                    unset($_SESSION['user']);
                    session_destroy();
                    header("Location:Home.php");
                }
                ?>
                <form method="POST">
                   <input type="submit" class="Logout_button" name="logout" value="LOGOUT" onclick="confirm(' GoodBye!!! ');">
               </form>
                </div> 
            </div>
            <div class="middleHead2">
                <br>
<!--                <sach class="search">
                    <form method="POST">
                        <input type="text" name="search" placeholder="search by staff ID.....">
                        <la><input type="submit" name="search" value="Search"></la>
                    </form>
                </sach>-->
                <br><br>
               <ul>
                     <li>
                         <a href="cashierHome.php">HOME</a>
                     </li>
                     <li>
                         <a href="#">SERVICE</a>
                     </li>
                     <li>
                         <a href="#">FEATURES</a>
                     </li>
                     <li>
                         <a href="#">CONTACT US</a>
                     </li>
                 </ul>
            </div>
        </div>
        <div class="section" style=" height: auto;">
            <br>
            <div class="midSection" style="height: auto;padding-top: 0px;">
                 <div class="SalaAtt">
                    <form method="POST">
                  <center>
                    Staff ID: <input type="text" name="id" placeholder="Staff id ID...." style=" font-size: 12px; font-style: italic;"><input type="submit" name="paySalary" value="OK">
                  </center>
                    </form>
                </div>
       <?php
       if($_POST['paySalary']!="")
   {
       $staff_id=$_POST['id'];
       if($staff_id!="")
       {
           //view attendance
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
                <div class="paystaff" style=" height: 82%;">
            <table border="1" cellpadding="5" style="height:100%;">
                <tr>
                    <th  colspan="6" style=" background-color: #663300;">
                        PREVIEW | Staff PayRoll 
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
              <?php echo $AttReslt['Surname'].",  ".$AttReslt['OtherName']." ".$AttReslt['FirstName'] ?> 
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
            <tr>
                <th colspan="5"  style=" background-color: whitesmoke;">
                  <a href="payreq.php?id=<?php echo $staff_id ?>"><font color="white">Send Request<font></a><a  href="printSlip.php?id=<?php echo $staff_id ?>"><font color="white">Print<font></a>
                </th>
            </tr>
        </table>
                </div>
                <?php 
       }else{
           echo "<script>alert('Staff ID cannot be Empty')</script>";  
       }
   }
       ?>
            </div>
        </div>
        <div class="footer">
            <div class="footerMiddle">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&copy;copyright 2016  <label style="color: #330000;">Fast PayRoll System 2016</label>
                <div class="footerMiddleLeft">
                    <label style="color: #330000;">Web Designed</label> by Isama |
                    <label1 style="color: #330000" >
                        <a href="" style="border-right:1px solid white; padding: 5px; text-decoration: none;color: #330000; ">About Us</a>
                        <a href="" style="border-right:1px solid white; padding: 5px; text-decoration: none;color: #330000; ">Other resources</a>
                        <a href="" style="border-right:1px solid white; padding: 5px; text-decoration: none;color: #330000; ">Privacy</a>
                        <a href="" style="padding: 5px; text-decoration: none;color: #330000; ">Terms</a>&nbsp;
                    </label1>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
//$_SESSION['user']=$usern;
}
else{
    header("Location:Home.php");
}
?>