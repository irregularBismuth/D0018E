<?php
session_start();
require_once  "db/db.php";
require_once "function.php";

$name=$_POST['name'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$spass=$_POST['samePass'];
$name=filter($name);
$email=filter($email);
$pass=filter($pass);
$spass=filter($spass);
if($pass!=$spass)
{
    header("Location: register.php?bad=1");
    exit(0);
}

$sql="select name from users where binary name=:u";
$s=$dbc->prepare($sql);
//$sql="insert into users (name,password) values (:u,:p)";
//$s=$dbc->prepare($sql);
$s->bindValue(":u",$name);
//$s->bindValue(":p",$pass);
$s->execute();
$res=$s->fetchAll();
if(s->rowCount() > 0)
{
    header("Location: register.php?bad=2");
    exit(0);
}
else {
    echo "peepo";
    $sql="insert into users (name,password,email) values (:t,:z,:q)";
    $s=$dbc->prepeare($sql);
    $s->bindValue(":t",$name);
    $s->bindValue(":z",$pass);
    $s->bindValue(":q",$email);
    $s->execute();
    header("Location: login.php?succ=1");
    exit(0);
}




?>
