<?php
session_start();
require_once "sqlHandler.php";
$id=$_POST['aid'];
$hid=$_POST['hid'];
$dll="update animals set animal_price=:x where animal_id=:y";
$sqlHandler->half_genericQuery($dll,2,array($hid,$id));

header("Location: page.php?a=".$id);
exit(0);




?>
