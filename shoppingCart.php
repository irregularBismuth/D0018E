<?php
session_start();
require_once "sqlHandler.php";


?>

<html>
 <head>
    <link rel="stylesheet" type="text/css" href="style/style.css" />
 </head>
    
<body>


<?php
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
    foreach($res as $res)
    {
        if($res['product_id']==$res['animal_id']){
            echo "<span>".$res['animal_name']." ".$res['animal_price']." ".$res['quantity']."</span>";
        }
       /*if($res['product_id']==$res['animal_id']){
            echo "<p>".$res['animal_id']."</p>"
       }*/
    }
    $quer="select * from animals";
    $sqlHandler->half_genericQuery($quer,0,0);  
    $res=$sqlHandler->s->fetchAll();
    foreach($res as $res){
        echo "<div class='animal'><img src=".$res['animal_image']."><p>".$res['animal_name']."</p><p>".$res['animal_price']."</p>";
        echo "<form action='scHandler.php' method='post'>";
        echo "<input type='hidden' name='uid' value=".$_SESSION['id']." ><input type='hidden' name='price' value=".$res['animal_price']."><input type='hidden' name='anmid' value=".$res['animal_id']."><input type='submit' value='Add'>"; 
        echo "</form></div>";  
   
     }
?>
</body>$

</html>
