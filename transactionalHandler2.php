<?php
session_start();
require_once("sqlHandler.php");
require_once("userProfile.php");


function addToCart()
{
    $quer="select * from cart where customer_id=:x";
    $arr=array($_SESSION['id']);
    $sqlHandler->half_genericQuery($quer,1,$arr);
    $res=$sqlHandler->s->fetchAll();
    if(empty($res))
    {
        $c="insert into cart(customer_id) values(:x)";
        $sqlHandler->half_genericQuery($c,1,$arr);
        $cid=$sqlHandler->s->getLastInsertedID();
    }else {
        $cid=res[0]['id'];
        
    }
    $ciq="select * from cart_item where cart_id=:x and product_id=:y";
    $sqlHandler->half_genericQuery($ciq,2,array())
} 
    
    

?>
