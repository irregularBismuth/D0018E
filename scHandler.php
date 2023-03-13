<?php
session_start();
require_once "sqlHandler.php";

$id=$_POST['anmid'];
$quer="select * from cart where customer_id=:x";
$sqlHandler->half_genericQuery($quer,1,array($_POST['uid']));
$res=$sqlHandler->s->fetchAll();
if($sqlHandler->s->rowCount() > 0)
{
    $yy=0;
    foreach($res as $res){$yy=$res['id'];}
    $query="select * from cart_item where cart_id=:x";
    $sqlHandler->half_genericQuery($query,1,array($yy));
    $rez=$sqlHandler->s->fetchAll();
    $zz=0;
    $qq=1;
    $alred=0;
    foreach($rez as $rez){
         if($rez['product_id']==$id){
            $zz=$rez['id'];
            $qq=$rez['quantity']; 
            $alred=1;
        }
    }
    $qq+=1;
    if($alred){
        $quer="update cart_item set quantity=:x where id=:y";
        $sqlHandler->half_genericQuery($quer,2,array($qq,$zz));
    
    }else {
        $quer="insert into cart_item(cart_id,product_id,quantity,price) values(:x,:y,1,:z)";
        $sqlHandler->half_genericQuery($quer,3,array($yy,$id,$_POST['price']));
    }
    
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
