<?php
ob_start();
include ('DBConnect.php');
?>
<?php
session_start();
if(($_SESSION['user']!="") && ($_SESSION['category']=="employer") &&  ($_SESSION['role']=="Admin"))
{
    $ID=$_SESSION['user'];
  $viewPass=  mysql_query("SELECT * FROM user WHERE  Username='$ID'");
 $PassRslt=  mysql_fetch_array($viewPass);
 $pas=$PassRslt['Password'];
 //
$viewStaff=  mysql_query("SELECT * FROM staff WHERE Staff_id='$ID'");
$Staffprofil=  mysql_fetch_array($viewStaff);
//
//$CurrentDay=  date('D');
$CurrentMonth=  date('M');
$CurrentYear=date('Y');
$msg="";
?>
<html>
    <head>
        <link href="css/report.css" type="text/css" rel="stylesheet">
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <title> Salary Menu</title>
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
                  <input onclick="document.getElementById('pass').style.visibility='visible', document.getElementById('hidePass').style.visibility='visible', document.getElementById('showpass').style.visibility='hidden'; " id="showpass" type="button" value="Show Password">
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
                <sach class="search">
                    <form method="POST">
                        <input type="text" name="search" placeholder="search.....">
                        <la><input type="submit" name="search" value="Search"></la>
                    </form>
                </sach>
                <br><br>
               <ul>
                     <li>
                         <a href="employerHome.php">HOME</a>
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
        <div class="section" style="height: auto;">
            <br>
            <div class="midSection" style="height: auto;">
                <div class="rpt">
                <div class=" SalaAtt">
                    <form method="POST">
                    <div id="reprt" style="width: 60%;" >
                    Salary: <select name="salaryCat">
                        <option>View History</option>
                        <option>View Request</option>
                    </select>
                    &nbsp;&nbsp;Staff ID:<input type="text" name="ID" placeholder="Staff ID..." style=" width: 40%; padding-left: 10px;">
                    </div>                
                    <div id="submt" style=" width: 8%;" >
                       <input type="submit" name="salary" value="OK">
                    </div>
                    <div id="mnthYr" >
                    Month: <select name="mnth">
                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>Apr</option>
                        <option>May</option>
                        <option>June</option>
                        <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                    </select>
                    Year:<select name="yr">
                        <option>2016</option>
                        <option>2015</option>
                        <option>2014</option>
                        <option>2013</option>
                        <option>2012</option>
                        <option>2011</option>
                        <option>2010</option>
                    </select>
                    </div>
                    </form>
                </div>
          <?php if($_POST['salary']!="")
                {
                 $SalaCat=$_POST['salaryCat'];
                 $id=$_POST['ID'];
                 $yr=$_POST['yr'];
                 $mnth=$_POST['mnth'];
                 if($SalaCat=="View History")
                 {
                     if($id!="")
                     {
                     $viewStfNnm=  mysql_query("SELECT * FROM staff WHERE Staff_ID='$id'");
                     $resltN=  mysql_fetch_array($viewStfNnm);
//                     echo 'welcome';
            ?> 
                <div class="salaryMonthly" style=" border-bottom: 1px solid saddlebrown;"> 
                    <br>
<table border="0" style=" width: 100%; height: auto;">
    <tr style="background-color: saddlebrown;">
        <th  colspan="13">
    <tit><?php echo $resltN['Surname'].",  ";?>Payment History</tit>
        </th>
    </tr>
    <tr style="background-color: #663300;">
                <th>SN</th>
                <th>Staff ID</th>
                <th>Surname</th>
                <th>First Name</th>
                <th>Other Name</th>
                <th>Worked Days</th>
                <th>Allowances</th>
                <th>Tax</th>
                <th>Gross Payment</th>
                <th>Net Payment</th>
                <th>Payment Date</th>
                <th>Month</th>
                <th>Year</th>
                
    </tr>
             <?php
//$view=  mysql_query("SELECT * FROM staff");
//view Attendance
           //  $date=  date('d:m:Y');
           // $id="";
$viewPay=  mysql_query("SELECT * FROM payhistory WHERE  Staff_ID='$id'");
//$Payreslt= mysql_fetch_array($viewPay);
$k=0;
while ($PayReslt=  mysql_fetch_array($viewPay))
{
//    $viewStfName=  mysql_query("SELECT * FROM staff WHERE Staff_ID='$id'");
//     $reslt=  mysql_fetch_array($viewStfName);
  $k++; 
?>
            <tr>
                <td>
                    <?php echo $k ?>
                </td>
                <td>
                    <?php echo $PayReslt['Staff_ID']; ?>
                </td> 
               <td>
                    <?php echo $resltN['Surname']; ?>
                </td> 
                <td>
                    <?php echo $resltN['FirstName']; ?>
                </td>
                <td>
                     <?php echo $resltN['OtherName']; ?>
                </td>
                <td>
                    <?php echo $PayReslt['WorkdDays']; ?>
                </td>
                <td>
                     <?php echo $PayReslt['Allowances']; ?>
                </td>
                <td>
                     <?php echo $PayReslt['Tax']; ?>
                </td>
                <td>
                   <?php echo $PayReslt['GrossPay']; ?> 
                </td>
                <td>
                   <?php echo $PayReslt['NetPay']; ?> 
                </td>
                <td>
                   <?php echo $PayReslt['PayDate']; ?> 
                </td>
                <td>
                   <?php echo $PayReslt['Month']; ?> 
                </td>
                <td>
                   <?php echo $PayReslt['Year']; ?> 
                </td>
            </tr>
            <?php
          //  $id=$AttReslt['Staff_ID'];
}
?>
</table>
</div>
                <?php
                     }
                     else{
                        $msg="<script>alert('Enter Staff ID')</script>"; 
                     }
                 }
                 else if($SalaCat=="View Request")
                     {
                     ?>
         <div class="salaryMonthly"> 
                    <br>
<table border="0" style=" width: 100%; height: auto;">
    <tr style="background-color: saddlebrown;">
        <th  colspan="14">
        <tit>Payment Request For the Month:  <?php echo $mnth." ".$yr?></tit>
        </th>
    </tr>
    <tr style="background-color: #663300;">
                <th>SN</th>
                <th>Staff ID</th>
                <th>Surname</th>
                <th>First Name</th>
                <th>Other Name</th>
                <th>Worked Days</th>
                <th>Allowances</th>
                <th>Tax</th>
                <th>Gross Payment</th>
                <th>Net Payment</th>
                <th>Payment Date</th>
                <th>Month</th>
                <th>Year</th>
                <th>Option</th>
    </tr>
             <?php
//$view=  mysql_query("SELECT * FROM staff");
//view Attendance
           //  $date=  date('d:m:Y');
           
$viewPay=  mysql_query("SELECT * FROM payrequest WHERE  Month='$mnth' AND Year='$yr'");
//$Payreslt= mysql_fetch_array($viewPay);
$k=0;
while ($PayReslt=  mysql_fetch_array($viewPay))
{
    $stfID=$PayReslt['Staff_ID'];
$staff=  mysql_query("SELECT * FROM staff WHERE Staff_ID='$stfID'");
$stfReslt=  mysql_fetch_array($staff);
  $k++; 
?>
            <tr>
                <td>
                    <?php echo $k ?>
                </td>
                <td>
                    <?php echo $PayReslt['Staff_ID']; ?>
                </td> 
               <td>
                    <?php echo $stfReslt['Surname']; ?>
                </td> 
                <td>
                    <?php echo $stfReslt['FirstName']; ?>
                </td>
                <td>
                     <?php echo $stfReslt['OtherName']; ?>
                </td>
                <td>
                    <?php echo $PayReslt['WorkdDays']; ?>
                </td>
                <td>
                     <?php echo $PayReslt['Allowances']; ?>
                </td>
                <td>
                     <?php echo $PayReslt['Tax']; ?>
                </td>
                <td>
                   <?php echo $PayReslt['GrossPay']; ?> 
                </td>
                <td>
                   <?php echo $PayReslt['NetPay']; ?> 
                </td>
                <td>
                   <?php echo $PayReslt['PayDate']; ?> 
                </td>
                <td>
                   <?php echo $PayReslt['Month']; ?> 
                </td>
                <td>
                   <?php echo $PayReslt['Year']; ?> 
                </td>
                <td><a href="payNow.php?id=<?php echo $PayReslt['Staff_ID'];?>">Approve Payment</a></td>
            </tr>
            <?php
          //  $id=$AttReslt['Staff_ID'];
}
?>
</table>
</div>
            <?php
                     
                 }
                 else{
                     echo '';
                     }
                 }
                 echo $msg;
          ?>
           </div>         
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
$_SESSION['user']=$ID;
}
else{
    header("Location:Home.php");
}
?>