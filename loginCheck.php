<?php
session_start();
require_once("classes/accountHandler.php");
$uname=$_POST['uname'];
//echo $uname;
$passw=$_POST['passw'];
//echo $uname;
//echo $passw;
loginFunc($uname,$passw);
header("Location: index.php");
exit(0);


?>
