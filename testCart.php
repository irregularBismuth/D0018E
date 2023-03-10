<?php
session_start();
require_once "sqlHandler.php";

$quer="select * from animals";
$ar=array();
$sqlHandler->half_genericQuery($quer,0,$ar);
$res=$sqlHandler->fetchAll();
foreach($res as $res)
{
    echo "<form action='addCart.php' method='post'><label>\"$res['animal_name']\"</label><input type='number' name='anum'><input type='submit'></form></br></br>";
}

?>
