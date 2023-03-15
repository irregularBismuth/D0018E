<?php 
session_start();

$newUsername = $_POST['uname'];
$id = $_POST['hid'];

if(!(isset($_SESSION['username']))){

header("Location: superProfile.php");
exit(0);
}
else {

header("Location: superProfile.php?bad=1");
exit(0);
}

?>
