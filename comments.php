<?php
session_start();
require_once "sqlHandler.php";

if(!(isset($_SESSION['username'])))
{
    header("Location: login.php?bad=2");
    exit(0);
}

$text=$_POST['comment'];
$uname=$_POST['name'];
$anmid=$_POST['animal_id'];
$sql="insert into comments(animal_id,parent_comment_id,comment,comment_username) values(:x,0,:y,:z)";
$arr=array($anmid,$text,$name);
$sqlHandler->half_genericQuery($sql,3,$arr);
//$res=$sqlHandler->s->fetchAll();

header("Location: page.php?a=".$anmid.");
exit(0);

?>
