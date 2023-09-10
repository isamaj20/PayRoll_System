<?php
ob_start();
include ('DBConnect.php');
function MNTH($mnth)
{
    if($mnth=="January")
    {
        return 1;
    }
    else if($mnth=="February")
    {
        return 2;
    }
    else if($mnth=="March")
    {
        return 3;
    }
    else if($mnth=="April")
    {
        return 4;
    }
    else if($mnth=="May")
    {
        return 5;
    }
    else if($mnth=="June")
    {
        return 6;
    }
    else if($mnth=="July")
    {
        return 7;
    }
    else if($mnth=="August")
    {
        return 8;
    }
    else if($mnth=="September")
    {
        return 9;
    }
    else if($mnth=="October")
    {
        return 10;
    }
    else if($mnth=="November")
    {
        return 11;
    }
    else if($mnth=="December")
    {
        return 12;
    }
}
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

//
//$CurrentDay=  date('D');
$CurrentMonth=  date('M');
$CurrentYear=date('Y');
?>
<html>
    <head>
        <link href="css/report.css" type="text/css" rel="stylesheet">
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <title> Staff Report</title>
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
                    <div id="reprt" >
                    Report: <select name="repCat">
                        <option>Salary</option>
                        <option>Attendance</option>
                    </select>
                    </div>                
                    <div id="submt" >
                       <input type="submit" name="report" value="OK">
                    </div>
                    <div id="mnthYr" style=" width: 50%;" >
                    Month: from <select name="mnthFrom">
                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>April</option>
                        <option>May</option>
                        <option>June</option>
                        <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                    </select>
                     to: <select name="mnthTo">
                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>April</option>
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
          <?php if($_POST['report']!="")
                {
                 $day = date('d');
                 $RrpCat=$_POST['repCat'];
                 $yr=$_POST['yr'];
                 $mnthFrm=$yr.'-'.MNTH($_POST['mnthFrom']).'-'.$day;
                 $mnthTo=$yr.'-'.MNTH($_POST['mnthTo']).'-'.$day;;
                 if($RrpCat=="Salary")
                 {
//                     echo 'welcome';
            ?> 
                <div class="salaryMonthly" style=" border-bottom: 1px solid saddlebrown;"> 
                    <br>
<table border="0" style=" width: 100%; height: auto;">
    <tr style="background-color: saddlebrown;">
        <th  colspan="13">
        <tit>Payment Report From:  <?php echo $mnthFrm."<font color='white'>  -TO- </font>".$mnthTo ?></tit>
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
          ;
$viewPay=  mysql_query("SELECT * FROM payhistory WHERE  PayDate>='$mnthFrm' && PayDate<='$mnthTo' && Year='$yr'");
//$Payreslt= mysql_fetch_array($viewPay);
$k=0;
while ($PayReslt=  mysql_fetch_array($viewPay))
{
      $id=$PayReslt['Staff_ID'];
    $viewStaff=  mysql_query("SELECT * FROM staff WHERE Staff_id='$id'");
    $Staffprofil=  mysql_fetch_array($viewStaff);
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
                    <?php echo $Staffprofil['Surname']; ?>
                </td> 
                <td>
                    <?php echo $Staffprofil['FirstName']; ?>
                </td>
                <td>
                     <?php echo $Staffprofil['OtherName']; ?>
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
            </tr>
</table>
</div>
                <?php
                 }
                 else if($RrpCat=="Attendance")
                     {
                     ?>
         <div class="salaryMonthly"> 
                    <br>
<table border="0" style=" width: 100%; height: auto;">
    <tr style="background-color: saddlebrown;">
        <th  colspan="10">
        <tit>Attendance From:  <?php echo $mnthFrm."<font color='white'>  -TO- </font>".$mnthTo?></tit>
        </th>
    </tr>
    <tr style="background-color: #663300;">
                <th>SN</th>
                <th>Staff ID</th>
                <th>Surname</th>
                <th>First Name</th>
                <th>Other Name</th>
                <th>Date</th>
                <th>Month</th>
                <th>Year</th>
    </tr>
             <?php
//$view=  mysql_query("SELECT * FROM staff");
//view Attendance
           //  $date=  date('d:m:Y');
            $id="";
$viewAtt=  mysql_query("SELECT * FROM attendance WHERE  Date>='$mnthFrm' && Date<='$mnthTo'");
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
            </tr>
            <?php
            $id=$AttReslt['Staff_ID'];
}
?>
            </tr>
</table>
</div>
            <?php
                     
                 }
 else {
                     echo '';
 }
                 }
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