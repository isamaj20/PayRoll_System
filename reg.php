<?php

?>
<html>
    <head>
        <style type="text/css">
#login{
/*    margin: 0; 
margin-left: 40%; 
margin-right: 40%;
*/
margin-top: 50px; 
padding-top: 10px; 
opacity:40;
/*opacity:.95;*/
display:none;
position:fixed;
/*background-color:#313131;*/
overflow:auto;
width: 20%; 
height:auto;
position: absolute; 
background: #FBFBF0; 
z-index: 9; 
visibility: hidden;
/*border: 1px solid #660000;*/
}
#login a{
    text-decoration: none;
   font-family:Arial, Helvetica, sans-serif;
    font-size:13px;
    color:#000;
    width:170px;
    height:24px;
    padding:0px 10px 10px 10px;
    background-color: saddlebrown;
    text-align:center;
    border:1px  #33C solid; 
}
        </style>
          <script language="JavaScript" type="text/javascript">
function login(showhide){
if(showhide == "show"){
    document.getElementById('login').style.visibility="visible";
    document.getElementById('login').style.display="block";
}else if(showhide == "hide"){
    document.getElementById('login').style.visibility="hidden"; 
}
}
</script>
    </head>
    <body>
        
    </body>
</html>