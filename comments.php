<?php
session_start();
require_once "sqlHandler.php";
$text=$_POST['comment'];
$uname=$_POST['name'];
$anmid=$_POST['animal_id'];
$query="insert into comments(animal_id,parent_comment_id,comment,comment_username) values(2,0,'test123','a')";
$arr=array($anmid,$text,$uname);
$sqlHandler->half_genericQuery($query,0,$arr);
//$res=$sqlHandler->s->fetchAll();
header("Location: page.php?a=".$anmid.");
exit(0);

?>
