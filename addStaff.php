<?php
ob_start();
include ('DBConnect.php');
?>
<?php
if($_POST['submit']!="")
{
    $surname=$_POST['Sname'];
    $firstname=$_POST['Fname'];
    $othername=$_POST['Oname'];
    $dob=$_POST['DOB'];
    $Gender=$_POST['gender'];
    $Number=$_POST['number'];
    $Address=$_POST['address'];
    $Email1=$_POST['email1'];
    $Email2=$_POST['email2'];
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
$locate="passport/";
$imgpath=$locate.$ima;
//
    if(($surname!="") && ($firstname!="") || ($othername!="") && ($dob!="") && ($Gender!="")
            && ($Number!="") && ($Address!="") && ($Email1!="") && ($Email2!="")
            && ($category!="...select...") && ($Username!="") && ($Password!="") && ($image!=""))
    {
        if(isset($image))
     {
if($extension=="jpg" || $extension=="jpeg" || $extension=="png")
    {
  //  $sn1=0;
    $serial=  mysql_query("select * from staff");
    $count=  mysql_fetch_array($serial);
    $sn1=mysql_num_rows($serial);
    $sn=$sn1+1;
           //
    $staff_id="PRO/STF/".$sn;
    $Email=$Email.$Email2;
            //
     $insertStf="INSERT into staff values ('$sn','$staff_id','$surname','$firstname','$othername','$dob','$Gender','$Number','$Address','$Email','$category','$imgpath')";
     $insertReslt=  mysql_query($insertStf);
      move_uploaded_file($temp,$imgpath);
     //
    $insertUser="INSERT into user values ('$Username','$Password','$category')";
    $insertReslt2=  mysql_query($insertUser);
    if($insertReslt && $insertReslt2)
    {
        $msg="New Staff And User Entered Successfully";
    }
    else
    {
        $msg="Failed to Carry out Transaction because ". mysql_error();
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
        <title> PayRoll | Add New Staff</title>
    </head>
    <body>
        <form method="POST" enctype="multipart/form-data">
            <table border="1">
                <tr>
                    <th colspan="4">
                        <?php  echo $msg ?>
                    </th>
                </tr>
                <tr>
                <th colspan="2">
                    Staff Information
                </th>
                <th colspan="2">
                    Payment Information
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
                 <th colspan="2">
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
                     <input type="date" name="DOB">
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
                     Gender
                 </td>
                 <td>
                     M <input type="radio" name="gender" value="Male"> F<input type="radio" name="gender" value="Female">
                 </td>
                 <th colspan="2">
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
                 <td rowspan="2">
                     <input type="file" name="file">
                 </td>
                 <td rowspan="2">
                 <img src="">
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
                     <input type="text" name="email1" placeholder="example">@<input type="text" name="email2" placeholder="gmail.com" style="width: 70px;">
                 </td>
                 <td colspan="2">
                     <center><input type="submit" name="submit" value="Register"></center>
                 </td>
             </tr>
            </table>
        </form>   
    </body>
</html>