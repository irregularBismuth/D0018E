<?php
session_start();
require_once("sqlHandler.php");
require_once("userProfile.php");


function addToCart()
{
    
    


 /*   $quer="select * from cart where customer_id=:x";
    $arr=array($_SESSION['id']);
    $sqlHandler->half_genericQuery($quer,1,$arr);
    $res=$sqlHandler->s->fetchAll();
    $cid=0;
    if(empty($res))
    {
        $c="insert into cart(customer_id) values(:x)";
        $sqlHandler->half_genericQuery($c,1,$arr);
        $cid=$sqlHandler->s->getLastInsertedID();
    }else {
        cid=$res[0]['id'];
        
    }
    $ciq="select * from cart_item where cart_id=:x and product_id=:y";
    $sqlHandler->half_genericQuery($ciq,2,array($cid,$_POST['product_id']));
    $cartData=$sqlHandler->s->fetchAll();
    if(empty($cartData))
    {
        $ciiq="insert into cart_item (cart_id,product_id,quantity,price) values(:x,:y,:z,:w)";
        $sqlHandler->half_genericQuery($ciiq,4,array($cid,$_POST['product_id'],1,$_POST['price']));
    }
    else{
        $new=$cartData[0]['quantity']+ 1; //quantity + 
        $ciiq="update cart_item set quantity =:x where cart_id=:y and product_id=:z";
        $sqlHandler->half_genericQuery($ciiq,3,array($new,$cid,$_POST['product_id']));
        
    } */
} 
    
    

?>
