<?php
session_start();
require_once "sqlHandler.php";
require_once "function.php";

$name=$_POST['name'];
$pass=$_POST['comment'];
echo $pass;
#$arr=array($name,$pass,$email);
#$sql="insert into comments (name,password,email) values (:x,:y,:z)";
#$sqlHandler->half_genericQuery($sql,3,$arr);
?>
