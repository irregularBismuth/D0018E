<?php
session_start();
require_once "sqlHandler.php";
$id=$_POST['hid'];
$n=$_POST['num'];

$milker="update odeitem set quantity=:x where id=:y";
$sqlHandler->half_genericQuery($milker,2,array($n,$id));

header("Location: showOrders.php");
exit(0);

?>

