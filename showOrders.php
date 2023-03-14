<?php
session_start();
//peepo
require_once "sqlHandler.php";
require_once("cartMenuSwitch.php");


if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit(0);
}

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

echo "<h1>Order history: </h1>";
foreach($rez as $rez){

    $odeid=$rez['id'];
    $milkert="select * from animals,ode_item where animal_id=product_id and odeid=:x";
    $sqlHandler->half_genericQuery($milkert,1,array($odeid));
    $p=$sqlHandler->s->fetchAll();    
    echo "order number: ".$rez['id']." Ordertime".$rez['dateTime'];
    foreach($p as $p)
    {
        echo "  ".$p['animal_name']." x ".$p['quantity']." price: ".$p['price']." ";    
    }
    echo " ".$rez['total']."</br>";
    
}

?>

</body>

</html>
