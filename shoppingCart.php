<?php
session_start();
require_once "sqlHandler.php";
$bad=$_GET['bad'];
?>

<html>
 <head>
    <link rel="stylesheet" type="text/css" href="style/style.css" />
 </head>
    
<body>


<?php
    if($bad==1){
        echo "More animals in cart then in stock please remove some to continue";
    }
    if($bad==2){
        echo "No animals in cart add some before checking out";
    }
    if($bad==3){
        echo "Not enough balance to buy these animals download more money before continueing";
    }
    echo "</br>";
    $quer="select * from cart where customer_id=:x";
    $sqlHandler->half_genericQuery($quer,1,array($_SESSION['id'])); 
    $res=$sqlHandler->s->fetchAll();
    $intid=0;
    foreach($res as $res)
    {
        $intid=$res['id'];
    }
    $quer="select * from animals,cart_item where cart_id=:x";
    $sqlHandler->half_genericQuery($quer,1,array($intid)); 
    $res=$sqlHandler->s->fetchAll();
    $tot=0;
    echo "<b>Shoppingcart:</b><br>";
    foreach($res as $res)
    {
        if($res['product_id']==$res['animal_id']){
           $tot+=$res['price']*$res['quantity']; 
            echo "<span>".$res['animal_name']." ".$res['animal_price']." x".$res['quantity']."</span><form action='removeCart.php' method='post' ><input type='hidden' name='cid' value=".$res['id']."><input type='hidden' name='aid' value=".$res['quantity']."><input type='submit' value='Remove'></form></br>";
        }
       /*if($res['product_id']==$res['animal_id']){
            echo "<p>".$res['animal_id']."</p>"
       }*/
    }
    echo "Total: ".$tot."</br><form action='checkOut.php' method='post'><input type='submit' value='Checkout'></form>";
    
    $quer="select * from animals";
    $sqlHandler->half_genericQuery($quer,0,0);  
    $res=$sqlHandler->s->fetchAll();
    foreach($res as $res){
    
        echo "<div class='animal'><img src=".$res['animal_image']."><p>".$res['animal_name']."</p><p>".$res['animal_price']."</p>";
        if($res['animal_quantity'] > 0){
        echo "<form action='scHandler.php' method='post'>";
        echo "<input type='hidden' name='uid' value=".$_SESSION['id']." ><input type='hidden' name='price' value=".$res['animal_price']."><input type='hidden' name='anmid' value=".$res['animal_id']."><input type='submit' value='Add'>"; 
        echo "</form></div>";  
        }
        else{
            echo "Item currently out of stock retry tomorrow";
        }
   
     }
?>
</body>$

</html>
