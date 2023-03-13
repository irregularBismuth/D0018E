<?php
session_start();
require_once "sqlHandler.php";
$aid=$_POST['aid'];
$cid=$_POST['cid'];

if($aid > 1){
$aid-=1;
$query="update cart_item set quantity=:x where id=:y";
$sqlHandler->half_genericQuery($query,2,array($aid,$cid));
}
else{
   $query="delete cart_item where id=:x";
   $sqlHandler->half_genericQuery($query,1,array($cid));
}

header("Location: shoppingCart.php");
exit(0);
?>
