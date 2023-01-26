<?php
session_start();
$name=$_POST['name'];
$pass=$_POST['pass'];
$spass=$_POST['samePass'];
if($pass!=$spass)
{
    header("Location: register.php?bad=1");
    exit(0);
}



?>
