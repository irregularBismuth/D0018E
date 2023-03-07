<?php
session_start();
require_once "sqlHandler.php";
require_once "function.php";

$name=$_POST['name'];
$pass=$_POST['comment'];
$ani=$_POST['animal_id'];
$ani=filter($ani);
$name=filter($name);
$pass=filter($pass);

$arr=array($ani,$pass,$name);
$sql="insert into comments (animal_id,comment,comment_username) values (:x,:y,:z)";
$sqlHandler->half_genericQuery($sql,3,$arr);
?>
