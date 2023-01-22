<?php
session_start();
//abc
require_once "db/db.php";
$sql="select id from users where binary name=:t and password=:u";
$s=$dbc->prepare($sql);
$s->bindValue(':t',"C.lay");
$s->bindValue(':u',"lin alg");
$s->execute();
$result=$s->fetchAll();
foreach ($result as $result){
    echo $result['id'];
}
?>

