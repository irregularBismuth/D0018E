<?php
session_start();
require_once "sqlHandler.php";
$quer="select * from order_info where order_id=:x";
$arr=array(1);
$sqlHandler->half_genericQuery($quer,1,$arr);
$res=$sqlHandler->s->fetchAll();

foreach($rez as $rez)
{
    
    $arr2=array($rez['product_id']);
    $quer="select * from animals where animal_id=:x";
    $sqlHandler->half_genericQuery($quer,1,$arr2);
    $rea=$sqlHandler->s->fetchAll();

}


?>
