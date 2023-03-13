<?php
session_start();
require_once "sqlHandler.php";

$n=$_POST['anum'];
$c=$_POST['acom'];
$a=$_POST['aname'];
$u=$_POST['aurl'];
$p=$_POST['hman'];
$quer="insert into animals(animal_name,animal_price,animal_image,animal_category,animal_quantity) values(:x,:y,:z,:w,".$p.")";
$arr=array($a,$n,$u,$c);
$sqlHandler->half_genericQuery($quer,4,$arr);

header("Location: productPage.php");
exit(0);

?>
