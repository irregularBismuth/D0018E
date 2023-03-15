<?php
session_start();
require_once "sqlHandler.php";

if($_SESSION['admin']==1){
$dll="select * from users";
$sqlHandler->half_genericQuery($dll,0,0);
$w=$sqlHandler->s->fetchAll();
    foreach($w as $w){
     echo "<form type=''>" 
     echo "<form type='deleteUser.php' method='post'><input type='hidden' value=".$w['id']."><input type='submit' value='deleteAccount'></form>";
    }
}




?>
