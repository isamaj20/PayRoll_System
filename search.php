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
    $viewPass=  mysql_query("SELECT * FROM user WHERE  Username='$ID'");
 $PassRslt=  mysql_fetch_array($viewPass);
 //$pas=$PassRslt['Password'];
            $day=date('d');
             $dy=  date('D');
             $month=  date('M');
             $year=date('Y');
//
                if($_GET['search']!="")
                {
                    $stfID=$_GET['id'];
                    if($stfID!="")
                    {
                $viewStaff=  mysql_query("SELECT * FROM staff WHERE Staff_id='$stfID'");
               $Staffprofil=  mysql_fetch_array($viewStaff);
                }
             else {
                $msg="Staff ID Is Empty";
                  }
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
        <div class="section">
            <br>
            <div class="midSection">
<!--                                                        Registration Form                                        -->
                <div id="viewProfile" name="prof">
                     <table border="0" cellspacing="5" >
                         <tr>
                             <td colspan="4" style=" background-color:  #CCC; color: crimson; font-size: 14px;" align="center">
                               <?php echo $msg ;?>  
                             </td>
                         </tr>
                <tr style="background-color: saddlebrown;">
                    <td colspan="4" align='center'>
                <tit >STAFF PROFILE</tit>
                    </td>
                </tr>
                <tr>
                    <th colspan="4" style="border-bottom:1px dashed #FFF;">
                        <?php  echo" Welcome to ".$Staffprofil['Surname']."'s Profile  "; ?>
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
                 <td>
                     Role :
                 </td>
                 <td>
                    <?php echo $Staffprofil['Role']; ?> 
                 </td>
             </tr>
             <tr>
                 <td>
                     Other  :
                 </td>
                 <td>
                     <?php echo $Staffprofil['OtherName']; ?> 
                 </td>
                 <th colspan="2" style="border-bottom:1px #663300 dashed;">
                     Login Information
                 </th>
             </tr>
             <tr>
                 <td>
                     Date OF Birth :
                 </td>
                 <td>
                     <?php echo $Staffprofil['DOB']; ?> 
                 </td>
                <td>
                     Username : 
                 </td>
                 <td style=" visibility: hidden;">
                    <?php echo $PassRslt['Username']; ?> 
                 </td>
             </tr>
             <tr>
                 <td>
                     Gender :
                 </td>
                 <td>
                    <?php echo $Staffprofil['Gender']; ?> 
                 </td>
                 <td>
                     Password :
                 </td>
                 <td style=" visibility: hidden;">
                      <?php echo $PassRslt['Password']; ?> 
                 </td> 
             </tr>
             <tr>
                 <td>
                     Phone Number :
                 </td>
                 <td>
                     0<?php echo $Staffprofil['PhoneNumber']; ?> 
                 </td>
                 <th colspan="2" style="border-bottom:1px #663300 dashed;">
                     Picture Upload
                 </th>
             </tr>
             <tr>
                 <td>
                     Address :
                 </td>
                 <td>
                     <textarea cols="20" rows="5" name="addr" onload="document.addr.disabled=true;"><?php echo $Staffprofil['Address']; ?></textarea>
                 </td>
                 <td style="border-bottom:1px #663300 dashed;">
                   Picture :
                 </td>
                 <td style="border-bottom:1px #663300 dashed;">
                     <img src="<?php echo $Staffprofil['imageURL']; ?> " height="150" width="200" alt="image">
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
                     <a href="employerHome.php">Back</a>
                 </td>
             </tr>
            </table>
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
