<?php
ob_start();
include ('DBConnect.php');
?>
<?php
 $msg="";
if(isset($_POST['submit'])!="")
{
    session_start();
    $username=$_POST['username'];
    $password=$_POST['password'];
    if($username!="" && $password!="")
{
 $query=  mysqli_query($con,"SELECT * FROM user WHERE Username='$username' && Password='$password'");
 $result=  mysqli_fetch_array($query);
 if($result)
 {
     $_SESSION['user']=$username;
     $_SESSION['category']=$result['Role'];
     $_SESSION['role']=$result['Cat_Role'];
     $_SESSION['password']=$result['Password'];
if($result['Password']==$password && $result['Role']=="senior" && $result['Cat_Role']=="Regular")
{
 header("Location:staffHome.php");   
}
else if ($result['Password']==$password && $result['Role']=="junior" && $result['Cat_Role']=="Regular") 
    {
 header("Location:staffHome.php");
}
else if ($result['Password']==$password && $result['Role']=="employer" && $result['Cat_Role']=="Admin") 
    {
//$msg="Welcome ".$username;
header("Location:employerHome.php");
}
else if ($result['Password']==$password && $result['Role']=="senior" && $result['Cat_Role']=="Cashier")
    {
header("Location:cashierHome.php");
}
else if ($result['Password']==$password && $result['Role']=="junior" && $result['Cat_Role']=="Cashier")
    {
header("Location:cashierHome.php");
}
else if ($result['Password']==$password && $result['Role']=="senior" && $result['Cat_Role']=="HRM")
    {
header("Location:hrmHome.php");
}
else if ($result['Password']==$password && $result['Role']=="junior" && $result['Cat_Role']=="HRM")
    {
header("Location:hrmHome.php");
}
 }
 else {
 $msg="Wrong username/password ";     
 }
}
 else {
    $msg="Fill All Fields";
}
}
?>
<html>
    <head>
        <link href="css/report.css" type="text/css" rel="stylesheet">
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <title> Home</title>
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
<!--            <div class="logoutHolder">
                 <div class="logout">
                    Logout here
                </div> 
            </div>-->
            <div class="middleHead2">
                <br>
<!--                <sach class="search">
                    <form method="POST">
                        <input type="text" name="search" placeholder="search.....">
                        <la><input type="submit" name="search" value="Search"></la>
                    </form>
                </sach>-->
                <br><br>
               <ul>
                     <li>
                         <a href="#">HOME</a>
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
                <div class="employee_login">
                    <tit>Important Information</tit> 
                    <p>
                    All Staff Must Login and Click on <b>Mark Attendance</b> to submit attendance.
                    <br>
                    <b>NOTE.</b> All request must be <b>Approved</b> by the HRM to  make it Valid
                    </p>
                </div>
                <div class="admin_login"    >
                     <form method="POST">
                        <table border="0" style="border:1px #EEE solid; width: 100%; height: 100%;">
                            <tr style="background-color:saddlebrown; color: antiquewhite;">
                                <th style="padding-left:10px; border-radius: 1em 1em 0em 0em;">
                                    User &nbsp;&nbsp;&nbsp;Login
                                </th>
                            </tr>
                            <tr>
                                <td style="padding-left:10px;font-size:15px; color:crimson; font-style: italic;">
                                    <center>
                                          <?php
                                      echo $msg;
                                          ?>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:10px;">
                                    Username
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:10px;">
                                    <input type="text" name="username" placeholder="username">
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:10px;">
                                    Password
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:10px;">
                                    <input type="password" name="password" placeholder="password">
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <input class="button" type="submit" name="submit" value="Login">
                                </th>
                            </tr>
                        </table>
                    </form>
                </div>
                <br><br><br><br><br><br><br><br><br><br><br><br><br>
                 <div class="body_part" style="background-image:url(images/end2end.jpg); background-repeat: no-repeat; background-size: 100% 100%;">
    
   
         
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