<?php
session_start();
require_once "sqlHandler.php";
$id=$_POST['hid'];
$n=$_POST['num'];

$milker="update ode_item set price=:x where id=:y";
$sqlHandler->half_genericQuery($milker,2,array($n,$id));
$milch="select * from ode_item where price=:x and id=:y";
$sqlHandler->half_genericQuery($milch,2,array($n,$id));
$zz=$sqlHandler->s->fetchAll();
$odeid=0;
foreach($zz as $zz){

$odeid=$zz['odeid'];

}

$milcher="select * from ode_item where odeid=:x";
$sqlHandler->half_genericQuery($milcher,1,array($odeid));
$ww=$sqlHandler->s->fetchAll();
if($sqlHandler->s->rowCount() >0){
$tot=0;
foreach($ww as $ww){
 $tot+=$ww['price']*$ww['quantity'];
}

$bate="update ode set total=:x where id=:y";
$sqlHandler->half_genericQuery($bate,2,array($tot,$odeid));
}



header("Location: showOrders.php");
exit(0);

?>

