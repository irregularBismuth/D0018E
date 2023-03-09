<?php
session_start();
require_once "sqlHandler.php";
$delid=$_POST['comid'];
$arr=array($delid);
$quer="delete from comments where comment_id=:x";
$sqlHandler->half_genericQuery($quer,1,$arr);

header("Location: page.php?a=".$_POST['aid']);
exit(0);



?>
