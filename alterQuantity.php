<?php
session_start();
require_once "sqlHandler.php";
$id=$_POST['hid'];
$n=$_POST['num'];

$milker="update ode_item set quantity=:x where id=:y";
$sqlHandler->half_genericQuery($milker,2,array($n,$id));

$milch="select * from ode_item where quantity=:x and id=:y";
$sqlHandler->half_genericQuery($milch,2,array($n,$id));
$zz=$sqlHandler->s->fetchAll();
$odeid=$zz['odeid'];
$milch="select * from ode_item where odeid=:x";
$sqlHandler->half_genericQuery($milch,1,array($odeid));
$ww=$sqlHandler->s->fetchAll();
$tot=0;
foreach($ww as $ww){
 $tot+=$ww['price']*$w['quantity'];
}
$bate="update ode set total=:x where id=:y";
$sqlHandler->half_genericQuery($bate,2,array($tot,$odeid));





header("Location: showOrders.php");
exit(0);

?>

