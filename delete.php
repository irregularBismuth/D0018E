<?php
session_start();
require_once "sqlHandler.php";
$quer="delete from animals where id=:x";
$anmid=$_POST['animal_id'];
$arr=array($anmid);
$sqlHandler->half_genericQuery($quer,1,$arr);

header("Location: productPage.php");
exit(0);

?>
