<?php
session_start();
//abc
require_once "db/db.php";
$sql="select id from users where binary name=:t and binary password=:u";
$s=$dbc->prepare($sql);
$username="C.lay";
$password="lin alg";
$s->bindValue(':t',$username);
$s->bindValue(':u',$password);
$s->execute();
$result=$s->fetchAll();
foreach ($result as $result){
    echo $result['id'];
    echo "debug 44445";
    echo "</br>peeepo";
}
print_r($result);
?>

