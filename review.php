<?php
session_start();
require_once "sqlHandler.php";
$id=$_SESSION['id'];
$milkerz="select * from ode where customer_id=:x";
$sqlHandler->half_genericQuery($milkerz,1,array($id));
$rez=$sqlHandler->s->fetchAll();
?>

<html>
<head>
</head>

<body>

<?php


foreach($rez as $rez){

    $odeid=$rez['id'];
    $milkert="select * from animals,ode_item where animal_id=product_id and odeid=:x";
    $sqlHandler->half_genericQuery($milkert,1,array($odeid));
    $p=$sqlHandler->s->fetchAll();    
        
    echo "order number: ".$rez['id']." Ordertime".$rez['dateTime'];
    foreach($p as $p)
    {
        echo "x".$p['quantity']." price: ".$p['price'];    
    }
    echo "</br>".$rez['total'];
    
}

?>

</body>

</html>
