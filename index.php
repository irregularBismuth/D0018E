<?php
session_start();
//abc
require_once "db/db.php";
$sql="select id from users where binary name='C.lay' and password='lin alg';";
$s=$dbc->prepare($sql);
$s->execute();
$result=$s->fetchAll();
foreach ($result as $result){
    echo $result['id'];
}
?>

