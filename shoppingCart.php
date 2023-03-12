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
    $quer="select * from cart_item where cart_id=:x";
    $sqlHandler->half_genericQuery($quer,1,array($intid)); 
    $res=$sqlHandler->s->fetchAll();
    foreach($res as $res)
    {
       $query="select * from animals where animal_id=:x";
       $sqlHandler->half_genericQuery($query,1,array($res['product_id']));
       $rez=$sqlHandler->s->fetchAll();
       foreach($rez as $rez){ echo "<div class='animal'><p>".$res['animal_name']."</p></div>"; }  
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
</body>

</html>
