<?php
session_start();
//abc
require_once "db/db.php";
$sql="select id from users where binary name=:name and binary password=:password";
$s=$dbc->prepare($sql);
$username=$_POST['name'];
$password=$_POST['pass'];
$s->bindValue(':name',$username);
$s->bindValue(':password',$password);
$s->execute();
$result=$s->fetchAll();
if($s->rowCount() > 0)
{
  echo $s->rowCount();
}
//foreach ($result as $result){
//    echo $result['id'];
//    echo "debug 44445";
//    echo "</br>peeepo";
//}
//print_r($result);
?>

