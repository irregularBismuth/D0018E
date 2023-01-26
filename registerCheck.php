<?php
session_start();
require_once  "db/db.php";
$name=$_POST['name'];
$pass=$_POST['pass'];
$spass=$_POST['samePass'];

if($pass!=$spass)
{
    header("Location: register.php?bad=1");
    exit(0);
}

$sql="select from users username where name=:u";
$s=$dbc->prepare($sql);

//$sql="insert into users (name,password) values (:u,:p)";
//$s=$dbc->prepare($sql);
$s->bindValue(":u",$name);
//$s->bindValue(":p",$pass);
$s->execute();
$res=$s->fetchAll();
if(s->rowCount() > 0)
{
    header("Location: register.php?badUsername=1");
    exit(0);
}




?>
