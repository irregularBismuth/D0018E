<?php
session_start();
require_once "sqlHandler.php";

$id=$_POST['anmid'];
$quer="select * from cart where customer_id=:x";
$sqlHandler->half_genericQuery($quer,1,array($_POST['uid']));
$res=$sqlHandler->s->fetchAll();
if($sqlHandler->s->rowCount() > 0)
{
    $intid=0;
    foreach($res as $res){
        $intid=$res['cart_id'];
    }
    $query="insert into cart_item(cart_id,product_id,quanity,price)";
    $sqlHandler->half_genericQuery($query,3,array($intid,$id,$_POST['price']))); 
}
else {
    $query="insert into cart(customer_id) values(:x)";
    $sqlHandler->half_genericQuery($query,1,array($_POST['uid']));
    $querry="select * from cart where customer_id=:x";
    $sqlHandler->half_genericQuery($querry,1,array($_POST['uid']));
    $res=$sqlHandler->s->fetchAll();
    $cartid=0;
    foreach ($res as $res){
        $cartid=$res['id'];
    }
    $quer="insert into cart_item(cart_id,product_id,quantity,price) values(:x,:y,1,:z)";
    $sqlHandler->half_genericQuery($quer,3,array($cartid,$id,$_POST['price']));
    
}


header("Location: shoppingCart.php");
exit(0);
?>