<?php
ob_start();
include ('DBConnect.php');
?>
<?php
session_start();
if(($_SESSION['user']!="") && ($_SESSION['category']=="employer") &&  ($_SESSION['role']=="Admin"))
{
    $msg="";
    $ID=$_SESSION['user'];
    $viewPass=  mysqli_query($con,"SELECT * FROM user WHERE  Username='$ID'");
 $PassRslt=  mysqli_fetch_array($viewPass);
 //$pas=$PassRslt['Password'];
            $day=date('d');
             $dy=  date('D');
             $month=  date('M');
             $year=date('Y');
//
                    $sn=$_GET['sn'];
                    if($sn!="")
                    {
                $viewMsg=  mysqli_query($con,"SELECT * FROM contact_us WHERE SN='$sn'");
               $message=  mysqli_fetch_array($viewMsg);
               $id=$message['From'];
               $viewSender=  mysqli_query($con,"SELECT * FROM staff WHERE Staff_ID='$id'");
               $viewSenderRslt=  mysqli_fetch_array($viewSender);
                }
             else {
                $msg="Please Select Message To Read.";
                  }              
   ?>
<html>
    <head>
        <link href="css/report.css" type="text/css" rel="stylesheet">
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <title> Admin. Home</title>
        <style type="text/css">
#viewProfile{
box-shadow: -2px 2px 2px #FBFBFF;
width:66%; 
height:63%;
position: absolute; 
background: #FBFBF0; 
z-index: 9; 
visibility: visible;
/*border: 1px solid #660000;*/
}
#viewProfile table{
    width: 100%;
    height: 100%;
    border-collapse: collapse;
}
        </style>
    </head>
    <body bgcolor="gainsboro" onload="document.MSG.msg.disabled=true;">
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
                  <div id="pass"> <?php echo"PASSWORD: *******" ?>
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
             <!--          <li>
                         <a href="#">CONTACT US</a>
                     </li>-->
                 </ul>
            </div>
        </div>
        <div class="section" style=" height: auto;">
            <br>
            <div class="midSection" style=" height: auto;">
<!--                                                        Registration Form                                        -->
<div id="suggestn">
    <form name="MSG">
        <?php echo " Message from :".$viewSenderRslt['Surname'].",  ".$viewSenderRslt['FirstName']."  ".$viewSenderRslt['OtherName'];?>
        <br>
    <textarea name="msg" rows="18" cols="100" style=" border-radius: 2em 0em 0em 2em; padding: 10px;"><?php echo $message['Message'];?></textarea>
    <br>
    <a href="suggestion.php">Back</a>
    </form>
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
//$_SESSION['user']=$usern;
}
else{
    header("Location:Home.php");
}
?>
