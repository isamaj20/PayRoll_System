<?php
ob_start();
include ('DBConnect.php');
?>
<?php
session_start();
if(($_SESSION['user']!="") && (($_SESSION['category']=="senior" && $_SESSION['role']=="Regular") || ($_SESSION['category']=="junior") && $_SESSION['role']=="Regular" ))
{
    $PassMsg="";
    $enqMsg="";
 $staff_id=$_SESSION['user'];
 $viewPass=  mysqli_query($con,"SELECT * FROM user WHERE  Username='$staff_id'");
 $PassRslt=  mysqli_fetch_array($viewPass);
 $pas=$PassRslt['Password'];
$CurrentDate=  date('D');
$CurrentMonth=  date('M');
$CurrentYear=date('Y');
//
$viewStaff=  mysqli_query($con,"SELECT * FROM staff WHERE Staff_id='$staff_id'");
$Staffprofil=  mysqli_fetch_array($viewStaff);
//
if(isset($_POST['changepass'])!="")
{
//    $usern=$_POST['usern'];
//    $oldpass=$_POST['old_password'];
    $newpass1=$_POST['new_password1'];
    $newpass2=$_POST['new_password2'];
    if( $newpass1!="" && $newpass2!="")
  {
    if($newpass1==$newpass2)
    {
         $updatePass=  mysqli_query($con,"UPDATE user SET Password='$newpass1' WHERE Username='$staff_id'");
         if($updatePass)
         {
             $PassMsg="Successfully Changed password";
         }
         else{
           $PassMsg="failed to Change password :".mysqli_error();  
         }
    }
    else{
        $PassMsg="password mismatch";
    }
  }
  else{
      $PassMsg="Fill All fields";
  }
}
if(isset($_POST['SEND'])!="")
{
//    $sender=$_POST['ID'];
//    $email=$_POST['EMAIL'];
    $subj=$_POST['SUBJECT'];
    $text=$_POST['MSG'];
    if($subj!="" && $text!="")
    {
      $email=$Staffprofil['Email'];  
      $viewmsg=  mysqli_query($con,"SELECT * FROM contact_us");
      $count=  mysql_num_rows($viewmsg);
      $sn=$count+1;
      $sendMsg=  mysqli_query($con,"INSERT INTO contact_us values ('$sn','$staff_id','$email','$subj','$text')");
      if($sendMsg)
       {
        $enqMsg="Message Successfully sent";  
      }
 else {
      $enqMsg="There was an Error, try again ".  mysqli_error();    
      }
    }
    else{
        $enqMsg="fill all fields";
    }
}
?>
<html>
    <head>
        <link href="css/report.css" type="text/css" rel="stylesheet">
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <title> Staff Home</title>
        <style type="text/css">
    #viewProfile{
/*    margin: 0; 
margin-left: 40%; 
margin-right: 40%;
*/
box-shadow: -2px 2px 2px #FBFBFF;
margin-top: -20px; 
/*padding-top: 10px; */
opacity:40;
/*opacity:.95;*/
display:none;
position:fixed;
/*background-color:#313131;*/
overflow:auto;
width:66%; 
height:66%;
position: absolute; 
background: #FBFBF0; 
z-index: 9; 
visibility: hidden;
/*border: 1px solid #660000;*/
}
 #editLogin{
/*    margin: 0; 
margin-left: 40%; 
margin-right: 40%;
*/
box-shadow: -2px 2px 2px #FBFBFF;
margin-top: -20px; 
/*padding-top: 10px; */
opacity:40;
/*opacity:.95;*/
display:none;
position:fixed;
/*background-color:#313131;*/
overflow:auto;
/*width: 28%;*/
float: left;
height: auto;
position: absolute; 
background: #FBFBF0; 
z-index: 9; 
visibility: hidden;
    margin: 0 auto;
    width: 24.7%;
    float: left;
    /*border: 1px black solid;*/
    border-radius: 1em 1em 0em 0em;
    color:  #cccccc;
    box-shadow: -2px -2px -2px #EEE;
    background-color:whitesmoke;
}
#pass{
    visibility: hidden;
}
#hidePass{
    visibility: hidden;
}
        </style>
          <script language="JavaScript" type="text/javascript">
function viewprofile(showhide){
if(showhide == "show"){
    document.getElementById('viewProfile').style.visibility="visible";
    document.getElementById('viewProfile').style.display="block";
}else if(showhide == "hide"){
    document.getElementById('viewProfile').style.visibility="hidden"; 
}
}
function editLogin(showhide){
if(showhide == "show"){
    document.getElementById('editLogin').style.visibility="visible";
    document.getElementById('editLogin').style.display="block";
}else if(showhide == "hide"){
    document.getElementById('editLogin').style.visibility="hidden"; 
}
}
</script>
    </head>
    <body bgcolor="gainsboro" onload="document.contact.ID.disabled=true, document.contact.NAME.disabled=true, document.contact.EMAIL.disabled=true, document.contact.SUBJECT.focus();">
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
                  CURRENT USER:
                  <br>
                  USER ID: &nbsp;&nbsp;&nbsp;<?php echo $staff_id; ?>
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
                  if(isset($_POST['logout'])!="")
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
                <div class="attendance">
                    <table border='0' cellspacing="5" > 
            <tr>
                <th colspan="4" style="border-bottom: 1px solid white;">
                   <tit>
                    Attendance
                   </tit>
                </th>
            </tr>
            <tr >
                <th >Date</th>
                <th >Month</th>
                <th >Year</th>
                <th >Select</th>
            </tr>
            <tr>
                <td>
                    <?php echo $CurrentDate ?>
                </td>
                <td>
                    <?php echo $CurrentMonth?>
                </td>
                <td>
                    <?php echo $CurrentYear ?>
                </td>
                <td>
                     &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<a href="attendanceRqst.php?id=<?php echo $staff_id ?>">Mark Attendance</a>
                </td>
            </tr>
        </table>   
                </div>
                <br><br>
               <ul>
                     <li>
                         <a href="Home.php">HOME</a>
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
        <div class="section">
            <br>
            <div class="midSection">
                <!--                                                          Edit Login                                                     -->
                <div id="editLogin">
                   <form method="POST" name="changePass">
                        <table border="0">
                            <tr style="background-color:saddlebrown; color: antiquewhite;">
                                <th style="padding:7px; border-radius: 1em 1em 0em 0em; padding-right:0px;">
                                    Change &nbsp;&nbsp;Password
                                </th>
                            </tr>
                            <tr>
                                <td style="padding-left:10px;">
                                    Username
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:10px;">
                                    <input type="text" name="usern" value="<?php echo $PassRslt['Username']; ?>" placeholder="<?php echo $PassRslt['Username']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:10px;">
                                  Old Password
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:10px;">
                                    <input type="password" name="old_password" value="<?php echo $PassRslt['Password']; ?>" placeholder="<?php echo $PassRslt['Password']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:10px;">
                                    New Password
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:10px;">
                                    <input type="password" name="new_password1" placeholder="new password">
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:10px;">
                                 Re-type New Password
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:10px;">
                                    <input type="password" name="new_password2" placeholder="new password">
                                </td>
                            </tr>
                            <tr>
                                <th>
                                   <a  class="button" href="javascript:editLogin('hide');">Close</a> <input class="button" type="submit" name="changepass" value="Update">
                                </th>
                            </tr>
                            <tr>
                                <td style="padding-left:10px;font-size:15px; color: crimson; font-style: italic;  background-color: #cccccc;">
                                    <center>
                                          <?php
                                      echo $PassMsg;
                                          ?>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
<!--                                                          Employee Actions                                                               -->
                <div class="employee_actions">
                    <tit>Navigation</tit>
                    <ul>
                        <li>
                            <a href="javascript:viewprofile('show');">View Profile</a>
                        </li>
                        <li>
                            <a href="javascript:editLogin('show');" onclick="document.changePass.usern.disabled=true, document.changePass.old_password.disabled=true, document.changePass.new_password.focus();">Edit Login</a>
                        </li>
                        <li>
                            <a onclick="document.contact.SUBJECT.focus();" href="#">Suggestion</a>
                        </li>
                    </ul>
                </div>
<!--                                                          View Profile                                                     -->
                <div id="viewProfile">
                     <table border="0" cellspacing="5">
                <tr style="background-color: saddlebrown;">
                    <td colspan="4">
                <tit>Staff Profile</tit>
                    </td>
                </tr>
                <tr>
                    <th colspan="4" style="border-bottom:1px dashed #FFF;">
                        <?php  echo" Welcome to Your Profile,  ".$Staffprofil['Surname']; ?>
                    </th>
                </tr>
                <tr >
                <th colspan="2" style="border-bottom:1px #663300 dashed;">
                    Staff Information
                </th>
                <th colspan="2" style="border-bottom:1px #663300 dashed;">
                    Employment Information
                </th>
                </tr>
             <tr>
                <td>
               Surname  :
                </td>
                <td>
              <?php echo $Staffprofil['Surname']; ?> 
                </td>
                 <td>
                     Staff Category :
                 </td>
                 <td>
                  <?php echo $Staffprofil['Category']; ?> 
                 </td>
             </tr>
             <tr>
                 <td>
                     First Name :
                 </td>
                 <td>
                     <?php echo $Staffprofil['FirstName']; ?> 
                 </td>
                 <th colspan="2" style="border-bottom:1px #663300 dashed;">
                     Login Information
                 </th>
             </tr>
             <tr>
                 <td>
                     Other  :
                 </td>
                 <td>
                     <?php echo $Staffprofil['OtherName']; ?> 
                 </td>
                 <td>
                     Username :
                     
                 </td>
                 <td>
                    <?php echo $PassRslt['Username']; ?> 
                 </td>
             </tr>
             <tr>
                 <td>
                     Date OF Birth :
                 </td>
                 <td>
                     <?php echo $Staffprofil['DOB']; ?> 
                 </td>
                 <td>
                     Password :
                 </td>
                 <td>
                      <?php echo $PassRslt['Password']; ?> 
                 </td>
             </tr>
             <tr>
                 <td>
                     Gender :
                 </td>
                 <td>
                    <?php echo $Staffprofil['Gender']; ?> 
                 </td>
                 <th colspan="2" style="border-bottom:1px #663300 dashed;">
                     Picture Upload
                 </th>
             </tr>
             <tr>
                 <td>
                     Phone Number :
                 </td>
                 <td>
                     0<?php echo $Staffprofil['PhoneNumber']; ?> 
                 </td>
                 <td rowspan="2" style="border-bottom:1px #663300 dashed;">
                   Picture :
                 </td>
                 <td style="border-bottom:1px #663300 dashed;">
                     <img src="<?php echo $Staffprofil['imageURL']; ?> " height="100" width="120" alt="image">
                 </td>
             </tr>
             <tr>
                 <td>
                     Address :
                 </td>
                 <td>
                     <?php echo $Staffprofil['Address']; ?>
                 </td>
             </tr>
             <tr>
                 <td>
                     Email :
                 </td>
                 <td>
                     <?php echo $Staffprofil['Email']; ?>
                 </td>
                 <td> 
                 </td>
                 <td> 
                     <a href="javascript:viewprofile('hide');">Close</a>
                 </td>
             </tr>
            </table>
                </div>
                <!--<br><br><br><br><br><br><br>-->
<!--                                                          Contact Us                                                    -->
                 <div class="contact_us">
                     <form method="POST" name="contact">
                     <table border="0" cellspacing="5" cellpadding="5px">
                         <tr style="background-color:saddlebrown;">
                             <th colspan="2" align="left" >
                               Contact Us | Question/Complain/Suggestions  
                             </th>
                         </tr>
                         <tr>
                             <td style="padding-left:10px;font-size:15px; color: crimson; font-style: italic;  background-color: #cccccc;" colspan="2" align="center">       
                                 <?php echo $enqMsg ; ?>
                             </td>
                         </tr>
                         <tr>
                             <td align="right" style="width: 150px;">
                                ID: 
                             </td>
                             <td>
                                 <input type="text" name="ID" value=" <?php echo $PassRslt['Username']; ?>" placeholder=" <?php echo $PassRslt['Username']; ?>">
                             </td>
                         </tr>
                         <tr>
                             <td align="right" style="width: 150px;">
                                 Name :
                             </td>
                             <td>
                                 <input type="text" name="NAME" placeholder=" <?php echo $Staffprofil['Surname'].",  ".$Staffprofil['FirstName']." ".$Staffprofil['OtherName']; ?>"
                             </td>
                         </tr>
                         <tr>
                             <td align="right" style="width: 150px;">
                                 Email :
                             </td>
                             <td>
                                 <input type="text" name="EMAIL" placeholder=" <?php echo $Staffprofil['Email']; ?>">
                             </td>
                         </tr>
                         <tr>
                             <td align="right" style="width: 150px;">
                                 Subject:
                             </td>
                             <td>
                                 <input type="text" name="SUBJECT"> 
                             </td>
                         </tr>
                         <tr>
                             <td colspan="2" style="width: 150px;" align="center">
                                 Description:
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 
                             </td>
                             <td align="right">
                                 <textarea type="textarea" cols="40" rows="8" name="MSG"></textarea>
                             </td>
                         </tr>
                         <tr>
                             <td colspan="2" align="right">
                                 <input  class="button" type="submit" name="SEND" value="Send" style="width:50px;">
                             </td>
                         </tr>
                     </table>
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
}
else{
    header("Location:Home.php");
}
?>
