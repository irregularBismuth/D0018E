<?php
session_start();
require_once "sqlHandler.php";

if($_SESSION['admin']==1){
$dll="select * from users";
$sqlHandler->half_genericQuery($dll,0,0);
$w=$sqlHandler->s->fetchAll();
    foreach($w as $w){
     echo "<h2>USER: ".$w['name']."</h2>";
     echo "Alter username <form type='alterUser.php'><input type='hidden' value=".$w['id']."></form>";
     echo "Alter balance of user <form method='post' action='alterCurrency.php'><input type='hidden'></form>";
     echo "<form type='deleteUser.php' method='post'><input type='hidden' value=".$w['id']."><input type='submit' value='deleteAccount'></form></br>";
    }
}
else {
    $dll="select * from users where id=:x";
    $sqlHandler->half_genericQuery($dll,1,array($_SESSION['id']));
    $w=$sqlHandler->s->fetchAll();
    
    echo "<>";  
}




?>
