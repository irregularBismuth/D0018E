<?php
session_start();
require_once "db/db.php";
    
$username=$_POST['name'];
 $password=$_POST['pass'];
function login($name,$pass){
    
    $sql="select * from users where binary name=:name and binary password=:password";
    $s=$dbc->prepare($sql);
    $s->bindValue(':name',$name);
    $s->bindValue(':password',$pass);
    $s->execute();
    $result=$s->fetchAll();
    
    if($s->rowCount() > 0)
    {
        echo $s->rowCount();
        echo "sista test";
     }
}
login($username,$password);
?>


