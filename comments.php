<?php
session_start();
require_once "sqlHandler.php";

$text=$_POST['comment'];
$uname=$_POST['name'];
$anmid=$_POST['animal_id'];

if(isset($_POST['subknapp']))
{

$quer="insert into comments(animal_id,parent_comment_id,comment,comment_username) values(:x,0,:y,:z)";
$arr=array($anmid,$text,$name);
echo $text;
echo "</br>".$name;
echo "</br>".$anmid;
$sqlHandler->half_genericQuery($quer,3,$arr);
//$res=$sqlHandler->s->fetchAll();
}
header("Location: page.php?a=".$anmid.");
exit(0);

?>
