<?php
session_start();
require_once("classes/accountHandler.php");
$uname=$_POST['uname'];
//echo $uname;
$passw=$_POST['passw'];
//echo $uname;
//echo $passw;
loginFunc($uname,$passw);
if(isset($_SESSION['username']))

  header("Location: index.php");
  exit(0);
}
header("Location: login.php?bad=1");
exit(0);


?>
