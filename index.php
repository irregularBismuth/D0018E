<?php
session_start();
require_once "db/db.php";
require_once "classes/accountHandler.php";
$handler->checkSession();
$sql="select id from users where id=1";
$s=$dbc->prepare($sql);
$s->execute();
$result=$s->fetchAll();
foreach ($result as $result){
    echo $result['id'];
}
?>

