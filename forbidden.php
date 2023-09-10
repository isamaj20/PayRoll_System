<?php 
$prev_page = $_SERVER['HTTP_REFERER'];
?>
<html>
    <head>
        <title>Error Page</title>
    </head>
    <body>
        <div  style="background-color:  burlywood; width: 40%; height: 50%; margin: 0 auto; padding: 10px;  ">
            <br>
            Hello! <p> If you are viewing this page then you are probably not <b>Authorized</b> to perform that transaction. </p> 
            <center><p><b>Click</b> <a href="<?php echo $prev_page;?>" onclock="">Back</a> to return to your Work</p></center>
        </div>
    </body>
</html>