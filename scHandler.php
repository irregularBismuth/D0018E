<?php
session_start();
require_once "sqlHandler.php";

$id=$_POST['anmid'];
$quer="select * from cart where customer_id=:x";
$sqlHandler->half_genericQuery($quer,1,array($_POST['uid']));
$res=$sqlHandler->s->fetchAll();
if($sqlHandler->s->rowCount() > 0)
{
 
}
else {
    $query="insert into cart(customer_id) values(:x)";
    $sqlHandler->half_genericQuery($query,1,array($_POST['uid']));
    $querry="select * from cart where customer_id=:x";
    $sqlHandler->half_genericQuery($querry,1,array($_POST['uid']));
    $res=$sqlHandler->s->fetchAll();
    foreach ($res as $res){
        $cartid=$res['id'];
    }
    $quer="insert into cart_item(cart_id,product_id,price) values(:x,:y,:z)";
    $sqlHandler->half_genericQuery($quer,3,array($cartid,$id,$_POST['price']));
    $res=$sqlHandler->s->fetchAll();
    
}


//header("Location: shoppingCart.php");
//exit(0);
?>
