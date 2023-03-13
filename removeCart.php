<?php
session_start();
require_once "sqlHandler.php";
$aid=$_POST['aid'];
$cid=$_POST['cid'];

$query="update cart_item set quantity=:x where id=:y";

if($aid >= 1){
$aid-=1;}

$sqlHandler->half_genericQuery($query,2,array($aid,$cid));

header("Location: shoppingCart.php");
exit(0);
?>
