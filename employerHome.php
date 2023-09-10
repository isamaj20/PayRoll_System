<?php
ob_start();
include ('DBConnect.php');
?>
<?php
session_start();
if(($_SESSION['user']!="") && ($_SESSION['category']=="employer") &&  ($_SESSION['role']=="Admin"))
{
    $ID=$_SESSION['user'];
    $viewPass=  mysqli_query($con,"SELECT * FROM user WHERE  Username='$ID'");
 $PassRslt=  mysqli_fetch_array($viewPass);
 $pas=$PassRslt['Password'];
            $day=date('d');
             $dy=  date('D');
             $month=  date('M');
             $year=date('Y');
if(isset($_POST['submit'])!="")
{
    $role="Regular";
    $surname=$_POST['Sname'];
    $firstname=$_POST['Fname'];
    $othername=$_POST['Oname'];
    $dob=$_POST['DOB'];
    $Gender=$_POST['gender'];
    $Number=$_POST['number'];
    $Address=$_POST['address'];
    $Email=$_POST['email'];
//    $Email2=$_POST['email2'];
    $category=$_POST['category'];
   // $allowances=implode(',',$_POST['allowance']);
    $Username=$_POST['username'];
    $Password=$_POST['password'];
    //picture upload
    $image=trim($_FILES["file"]["name"]);
$size=trim($_FILES["file"]["size"]);
$temp=trim($_FILES["file"]["tmp_name"]);
$extension=strtolower(substr($image,strpos($image,".")+1));//converting file extension image name into lower case//strrt()=help to removed image b4 dout//
$ima=time().substr(str_replace(" ","_",$image),5);// to generate  five roundown number first 5 alphabelt name of image//
$locate="images/Uploaded/";
$imgpath=$locate.$ima;
//
    if(($surname!="") && ($firstname!="") || ($othername!="") && ($dob!="") && ($Gender!="")
            && ($Number!="") && ($Address!="") && ($Email1!="") && ($Email2!="")
            && ($category!="...select...") && ($image!=""))
    {
        if(isset($image))
     {
if($extension=="jpg" || $extension=="jpeg" || $extension=="png")
    {
  //  $sn1=0;
    $serial=  mysqli_query($con,"select * from staff");
    $count=  mysqli_fetch_array($serial);
    $sn1=mysqli_num_rows($serial);
    $sn=$sn1+1;
           //
    $staff_id="PRO/STF/".$sn;
//    $Email=$Email1.$Email2;
            //
     $insertStf="INSERT into staff values ('$sn','$staff_id','$surname','$firstname','$othername','$dob','$Gender','$Number','$Address','$Email','$category','$imgpath','$role')";
     $insertReslt=  mysqli_query($con,$insertStf);
      move_uploaded_file($temp,$imgpath);
     //
    $insertUser="INSERT into user values ('$staff_id','$staff_id','$category','$role')";
    $insertReslt2=  mysqli_query($con,$insertUser);
    //
    if($category=="senior")
    {
        $cloth="YES";
        $house="YES";
        $medical="YES";
        $transport="YES";
    $serial2=  mysqli_query($con,"select * from allowances");
    $count=  mysqli_fetch_array($serial2);
    $sn1=mysqli_num_rows($serial2);
    $sn=$sn1+1;
    $insrtAllow="INSERT INTO allowances values('$sn','$staff_id','$cloth','$house','$medical','$transport')";
    $insrtAllowQry=  mysqli_query($con,$insrtAllow);
    $amount=200000;
    $insrtSala="INSERT INTO salary values('$staff_id','$amount','$category','$role')";
    $insrtSalaQry=  mysqli_query($con,$insrtSala);
    }
    else{
         $cloth="NO";
        $house="No";
        $medical="YES";
        $transport="YES";
    $serial2=  mysqli_query($con,"select * from allowances");
    $count=  mysqli_fetch_array($serial2);
    $sn1=mysqli_num_rows($serial2);
    $sn=$sn1+1;
    $insrtAllow="INSERT INTO allowances values('$sn','$staff_id','$cloth','$house','$medical','$transport')";
    $insrtAllowQry=  mysqli_query($con,$insrtAllow);
    $amount=100000;
    $insrtSala="INSERT INTO salary values('$staff_id','$amount','$category','$role')";
    $insrtSalaQry=  mysqli_query($con,$insrtSala);
    }
      //
    if($insertReslt && $insertReslt2 && $insrtAllowQry)
    {
        
        $msg="New Staff And User Entered Successfully";
    }
    else
    {
        $msg="Failed to Carry out Transaction because ". mysqli_error();
    }
    }
 else {
     $msg="invalid image format ".$extension;    
     }
     }
     else
     {
         $msg="Select an image";
     }
    }
 else {
    $msg="all fields are required";    
    }
}
?>
<html>
    <head>
        <link href="css/report.css" type="text/css" rel="stylesheet">
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <title> Admin. Home</title>
        <style type="text/css">
#viewStaffProf{
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
visibility: visible;
/*border: 1px solid #660000;*/
}
 #regNow{
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
#viewAll{
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
height:auto;
position: absolute; 
background: #FBFBF0; 
z-index: 9; 
visibility: hidden;
/*border: 1px solid #660000;*/
}
#viewSenior{
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
height:auto;
position: absolute; 
background: #FBFBF0; 
z-index: 9; 
visibility: hidden;
/*border: 1px solid #660000;*/
}
#viewJunior{
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
height:auto;
position: absolute; 
background: #FBFBF0; 
z-index: 9; 
visibility: hidden;
/*border: 1px solid #660000;*/
}
#monthlyAtt{
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
height:auto;
position: absolute; 
background: #FBFBF0; 
z-index: 9; 
visibility: hidden;
/*border: 1px solid #660000;*/
}
#monthlSala{
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
height:auto;
position: absolute; 
background: #FBFBF0; 
z-index: 9; 
visibility: hidden;
/*border: 1px solid #660000;*/
}
#reqAtt{
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
height:auto;
position: absolute; 
background: #FBFBF0; 
z-index: 9; 
visibility: hidden;
/*border: 1px solid #660000;*/
}
#pass{
    visibility: hidden;
}
#hidePass{
    visibility: hidden;
}
        </style>
          <script language="JavaScript" type="text/javascript">
function register(showhide){
if(showhide == "show"){
    document.getElementById('regNow').style.visibility="visible";
    document.getElementById('regNow').style.display="block";
}else if(showhide == "hide"){
    document.getElementById('regNow').style.visibility="hidden"; 
}
}
function viewAll(showhide){
if(showhide == "show"){
    document.getElementById('viewAll').style.visibility="visible";
    document.getElementById('viewAll').style.display="block";
}else if(showhide == "hide"){
    document.getElementById('viewAll').style.visibility="hidden"; 
}
}
function viewSenior(showhide){
if(showhide == "show"){
    document.getElementById('viewSenior').style.visibility="visible";
    document.getElementById('viewSenior').style.display="block";
}else if(showhide == "hide"){
    document.getElementById('viewSenior').style.visibility="hidden"; 
}
}
function viewJunior(showhide){
if(showhide == "show"){
    document.getElementById('viewJunior').style.visibility="visible";
    document.getElementById('viewJunior').style.display="block";
}else if(showhide == "hide"){
    document.getElementById('viewJunior').style.visibility="hidden"; 
}
}
function monthlyAttend(showhide){
if(showhide == "show"){
    document.getElementById('monthlyAtt').style.visibility="visible";
    document.getElementById('monthlyAtt').style.display="block";
}else if(showhide == "hide"){
    document.getElementById('monthlyAtt').style.visibility="hidden"; 
}
}
function reqattend(showhide){
if(showhide == "show"){
    document.getElementById('reqAtt').style.visibility="visible";
    document.getElementById('reqAtt').style.display="block";
}else if(showhide == "hide"){
    document.getElementById('reqAtt').style.visibility="hidden"; 
}
}
function monthlysalary(showhide){
if(showhide == "show"){
    document.getElementById('monthlySala').style.visibility="visible";
    document.getElementById('monthlySala').style.display="block";
}else if(showhide == "hide"){
    document.getElementById('monthlySala').style.visibility="hidden"; 
}
}
</script>
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
                <sach class="search">
                    <form method="GET" action="search.php">
                        <input type="text" name="id" placeholder="search staff by ID....">
                        <la><input type="submit" name="search" value="Search"></la>
                    </form>
                </sach>
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
<!--              <div id="regNow" style=" border-bottom:  1px solid saddlebrown;">
        <form method="POST" enctype="multipart/form-data" name="registr" onsubmit="document.getElementById('regNow').style.visibility='visible';" >
            <table border="0">
                <tr style="background-color: saddlebrown;">
                    <td colspan="4">
                <tit>Staff Registration</tit>
                    </td>
                </tr>
                <tr>
                    <th colspan="4">
                        <?php // echo $msg ?>
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
               Surname 
                </td>
                <td>
                <input type="text" name="Sname" placeholder="surname">
                </td>
                 <td>
                     Staff Category 
                 </td>
                 <td>
                     <select name="category">
                         <option>...select...</option>
                         <option>senior</option>
                         <option>junior</option>
                     </select>
                 </td>
             </tr>
             <tr>
                 <td>
                     First Name
                 </td>
                 <td>
                     <input type="text" name="Fname" placeholder="First name">
                 </td>
                 <th colspan="2" style="border-bottom:1px #663300 dashed;">
                     Login Information
                 </th>
             </tr>
             <tr>
                 <td>
                     Other Name
                 </td>
                 <td>
                     <input type="text" name="Oname" Placeholder="Other name">
                 </td>
                 <td>
                     Username
                     
                 </td>
                 <td>
                     <input type="text" name="username" placeholder="username">
                 </td>
             </tr>
             <tr>
                 <td>
                     Date OF Birth
                 </td>
                 <td>
                     <input type="date" name="DOB" placeholder="mm / dd / yy">
                 </td>
                 <td>
                     Password
                 </td>
                 <td>
                     <input type="password" name="password" placeholder="password">
                 </td>
             </tr>
             <tr>
                 <td>
                     Gender:
                 </td>
                 <td>
                     M <input type="radio" name="gender" value="Male" style="width:20px;"> F<input type="radio" name="gender" value="Female" style="width:20px;">
                 </td>
                 <th colspan="2" style="border-bottom:1px #663300 dashed;">
                     Picture Upload
                 </th>
             </tr>
             <tr>
                 <td>
                     Phone Number
                 </td>
                 <td>
                     <input type="text" name="number" placeholder="number">
                 </td>
                 <td rowspan="2" style="border-bottom:1px #663300 dashed;">
                     <input type="file" name="file" style="border:none;">
                 </td>
                 <td style="border-bottom:1px #663300 dashed;">
                     <img src="<?php// if($image!=""){ echo $imgpath;}?>" height="100" width="120" alt="image">
                 </td>
             </tr>
             <tr>
                 <td>
                     Address
                 </td>
                 <td>
                     <input type="text" name="address" placeholder="address">
                 </td>
             </tr>
             <tr>
                 <td>
                     Email
                 </td>
                 <td>
                     <input type="text" name="email" placeholder="example@gmail.com">
                 </td>
                 <td> 
                 </td>
                 <td> 
                     <a  class="button" href="javascript:register('hide');">Close</a><input class="button" type="submit" name="submit" value="Register" style="float:right; width: 80px;background-color: saddlebrown;">
                 </td>
             </tr>
            </table>
        </form>   
            </div>-->
<!--End of Registration form-->
<!--                                                                    View Staff
                                                            View All                         -->
<div id="viewAll" style=" border-bottom:   1px solid saddlebrown;"> 
<table border="0">
    <tr style="background-color: saddlebrown;">
        <th  colspan="10">
    <tit>All Staff of JonyBoss Ventures</tit>
        </th>
    </tr>
    <tr style="background-color: #663300;">
        <th>SN</th>
         <th>ID</th>
         <th>Surname</th>
         <th>First Name</th>
         <th>Gender</th>
         <th>Telephone</th>
         <th>Category</th>
    </tr>
              <?php
$view=  mysqli_query($con,"SELECT * FROM staff");
$k=0;
while ($viewReslt=  mysqli_fetch_array($view))
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
                    0<?php echo $viewReslt['PhoneNumber']; ?>
                </td>
                <td>
                    <?php echo $viewReslt['Category']; ?>
                </td>
<!--                <td>
                    <a href="payStaff.php?id=<?php //echo $viewReslt['Staff_ID'] ?>">Pay Salary</a>
                </td>
                <td>
                    <a href="PayHistory.php?id=<?php //echo $viewReslt['Staff_ID'] ?>">Payment History</a>
                </td>
                <td>
                    <a href="viewStaffAttendance.php?id=<?php //echo $viewReslt['Staff_ID'] ?>">Attendance</a>
                </td>-->
            </tr>
            <?php
}
?>
            <tr>
                <td>
                    <a class="button" href="javascript:viewAll('hide');">Close</a>
                </td>
            </tr>
</table>
</div>
<!--                                                            End Of view All Staff               -->
<!--                                                          View Senior Staff only                  -->
<div id="viewSenior" style=" border-bottom:   1px solid saddlebrown;"> 
<table border="0">
    <tr style="background-color: saddlebrown;">
        <th  colspan="10">
    <tit>Senior Staff of JonyBoss Ventures</tit>
        </th>
    </tr>
    <tr style="background-color: #663300;">
        <th>SN</th>
         <th>ID</th>
         <th>Surname</th>
         <th>First Name</th>
         <th>Gender</th>
         <th>Telephone</th>
         <th>Category</th>
    </tr>
              <?php
              $SeniorCat="senior";
$viewS=  mysqli_query($con,"SELECT * FROM staff WHERE Category='$SeniorCat'");
$k=0;
while ($viewReslt=  mysqli_fetch_array($viewS))
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
                    0<?php echo $viewReslt['PhoneNumber']; ?>
                </td>
                <td>
                    <?php echo $viewReslt['Category']; ?>
                </td>
<!--                <td>
                    <a href="payStaff.php?id=<?php// echo $viewReslt['Staff_ID'] ?>">Pay Salary</a>
                </td>
                <td>
                    <a href="PayHistory.php?id=<?php// echo $viewReslt['Staff_ID'] ?>">Payment History</a>
                </td>
                <td>
                    <a href="viewStaffAttendance.php?id=<?php// echo $viewReslt['Staff_ID'] ?>">Attendance</a>
                </td>-->
            </tr>
            <?php
}
?>
            <tr>
                <td>
                    <a class="button" href="javascript:viewSenior('hide');">Close</a>
                </td>
            </tr>
</table>
</div>
<!--                                                    view Junior staff                              -->
<div id="viewJunior" style=" border-bottom:   1px solid saddlebrown;"> 
<table border="0">
    <tr style="background-color: saddlebrown;">
        <th  colspan="10">
    <tit>Junior Staff of JonyBoss Ventures</tit>
        </th>
    </tr>
    <tr style="background-color: #663300;">
        <th>SN</th>
         <th>ID</th>
         <th>Surname</th>
         <th>First Name</th>
         <th>Gender</th>
         <th>Telephone</th>
         <th>Category</th>
    </tr>
<?php
$JuniorCat="junior";
$viewJ=  mysqli_query($con,"SELECT * FROM staff WHERE Category='$JuniorCat'");
$k=0;
while ($viewReslt=  mysqli_fetch_array($viewJ))
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
                    0<?php echo $viewReslt['PhoneNumber']; ?>
                </td>
                <td>
                    <?php echo $viewReslt['Category']; ?>
                </td>
<!--                <td>
                    <a href="payStaff.php?id=<?php// echo $viewReslt['Staff_ID'] ?>">Pay Salary</a>
                </td>
                <td>
                    <a href="PayHistory.php?id=<?php// echo $viewReslt['Staff_ID'] ?>">Payment History</a>
                </td>
                <td>
                    <a href="viewStaffAttendance.php?id=<?php// echo $viewReslt['Staff_ID'] ?>">Attendance</a>
                </td>-->
            </tr>
            <?php
}
?>
            <tr>
                <td>
                    <a class="button" href="javascript:viewJunior('hide');">Close</a>
                </td>
            </tr>
</table>
</div>
<!--                                                  End of View Junior Staff   
                                                           Monthly Attendance                -->
<div id="monthlyAtt" style=" border-bottom:   1px solid saddlebrown;"> 
<table border="0">
    <tr style="background-color: saddlebrown;">
        <th  colspan="10">
        <tit>Attendance For the Month:  <?php echo $month." ".$year?></tit>
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
$viewAtt=  mysqli_query($con,"SELECT * FROM attendance WHERE  Month='$month' && Year='$year'");
$AttTotal= mysqli_num_rows($viewAtt);
$k=0;
while ($AttReslt=  mysqli_fetch_array($viewAtt))
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
      <!--          <td>
                     <?php //echo $AttTotal; ?>
                </td>
                <td>
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
                <th colspan="5" align="left" style=" border-bottom:none;">
                   <a class="button" href="javascript:monthlyAttend('hide');">Close</a>
                </th>           
<!--                <th colspan="4" >
                    <a class="button" href="payStaff.php?id=<?php// echo $id ?>">Pay Salary</a> 
                </th>-->
            </tr>
</table>
</div>
<!--                                                            End of Monthly Attendance                  
                                                                          Attendance Request              -->
<!--          <div id="reqAtt" style=" border-bottom:   1px solid saddlebrown;">
            <table border="0">
            <tr style="background-color: saddlebrown;">
                <th colspan="9">
                    <tit>
                  Attendance For the Day:  <?php //echo $dy." ,".$day." ".$month." ".$year?>
                    </tit>
                </th>
            </tr>
            <tr style="background-color: #663300;">
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
//            $date=  date('20y:m:d');
//            $id="";
//$viewAttR=  mysql_query("SELECT * FROM attendancereq WHERE Date='$date'");
////$AttTotal= mysql_num_rows($viewAtt);
//$j=0;
//while ($AttReslt=  mysql_fetch_array($viewAttR))
//{
//  $j++; 
?>
            <tr>
                <td>
                    <?php //echo $j ?>
                </td>
                <td>
                    <?php //echo $AttReslt['Staff_ID']; ?>
                </td> 
               <td>
                    <?php //echo $AttReslt['Surname']; ?>
                </td> 
                <td>
                    <?php //echo $AttReslt['FirstName']; ?>
                </td>
                <td>
                     <?php //echo $AttReslt['OtherName']; ?>
                </td>
                <td>
                    <?php //echo $AttReslt['Date']; ?>
                </td>
                <td>
                     <?php //echo $AttReslt['Month']; ?>
                </td>
                <td>
                     <?php //echo $AttReslt['Year']; ?>
                </td>
              <td>
                    <a class="button" href="Attendance.php?id=<?php //echo $AttReslt['Staff_ID'] ?>">Approve Attendance</a>
              </td>
                  
                <td>
                    <a href="Attendance.php?id=<?php //echo $viewReslt['Staff_ID'] ?>">Attendance</a>
                </td>
            </tr>
            <?php
 //           $id=$AttReslt['Staff_ID'];
//}
?>
            <tr>
                <th style=" border-bottom:none;">
                    <a class="button" href="javascript:reqattend('hide');">Close</a>
                </th>
            </tr>
        </table>
</div>-->
<!--                                       Admin. Actions        
                                           Search Staff                        -->
               
                <div class="admin_actions">
                                <titl>
                                     &nbsp;&nbsp;Navigation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </titl>
<!--                    <div class="register">
                        <a href="javascript:register('show');" onclick="document.registr.username.disabled=true, document.registr.password.disabled=true;" ><img src="images/register.png"></a>  
                    </div>-->
                               <ul>
                                     <li >
                                         <a href="#">Employee</a>
                                         <ul>
                                             <li>
                                                 <a href="javascript:viewAll('show');">View All</a>
                                             </li>
                                             <li >
                                                 <a href="#">View By Category</a>
                                                 <ul>
                                                     <li>
                                                         <a href="javascript:viewSenior('show');">Senior Employee</a>
                                                     </li>
                                                     <li>
                                                         <a href="javascript:viewJunior('show');">Junior Employee</a>
                                                     </li>
                                                 </ul> 
                                             </li>
                                         </ul>
                                      </li> 
                                      <li>
                                          <a href="report.php">Reports</a>
                                      </li>
                                      <li>
                                          <a href="#">Attendance</a>
                                          <ul id="attend">
                                              <li>
                                                  <a href="javascript:monthlyAttend('show');">View Attendance</a>
                                              </li>
<!--                                              <li>
                                                  <a href="javascript:reqattend('show');">View Request</a>
                                              </li>-->
                                          </ul>
                                      </li>
                                      <li>
                                          <a href="salaReq.php">Salary</a>
                                      </li>
                                      <li>
                                          <a href="suggestion.php">View Suggestions</a>
                                      </li>
                                   </ul>
                </div>
                <div class="admin_brief">
                                <titl>
                                    Brief &nbsp;&nbsp;&nbsp;Information&nbsp;&nbsp;&nbsp;&nbsp;
                                </titl>
                     <p>FastPayRoll is a payroll management system 
                     designed exclusively for JonyBoss Ventures to manage employee 
                     salary details and accounting. 
                     Different branches/divisions under the company can also be managed here.
                     </p>      
                </div>
                <br><br><br><br><br><br><br><br><br><br><br><br>
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
<?php
//$_SESSION['user']=$usern;
}
else{
    header("Location:Home.php");
}
?>
