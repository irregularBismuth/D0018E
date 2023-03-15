<?php
session_start();
require_once "sqlHandler.php";
$id=$_POST['hid'];
$num=$_POST['num'];

$milker="update users set balance=:x where id=:y";
$sqlHandler->half_genericQuery($milker,2,array($num,$id));
header("Location: superProfile.php?succ=1");
exit(0);

?>
