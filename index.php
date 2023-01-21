<?php
session_start();
//abc
require_once "db/db.php";
$sql="select id from users where id=1";
$s=$dbc->prepare($sql);
$s->execute();
$result=$s->fetchAll();
foreach ($result as $result){
    echo $result['id'];
}
?>

