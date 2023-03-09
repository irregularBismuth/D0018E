<?php
session_start();
require_once "sqlHandler.php";
$delid=$_GET['comid'];
$anmid=$_GET['aid'];
$arr=array($delid);
$quer="delete from comments where comment_id=:x";
//$sqlHandler->half_genericQuery($quer,1,$arr);
//header("Location: page.php?a=".$anmid);
//exit(0);
echo $anmid;


?>
