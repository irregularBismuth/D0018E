<?php
session_start();
//require_once  "db/db.php";
require_once "function.php";
require_once "sqlHandler.php";
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
$arr=array($name);
$sql="select * from users where binary name=:x";
$s=$sqlHandler->half_genricQuery($sql,1,$arr);
$res=$s->fetchAll();
if($s->rowCount() > 0)
{
    header("Location: register.php?bad=2");
    exit(0);
}
//$sql="select * from users where binary name=:x";
//$s=$sqlHandler->half_genricQuery($sql,1,$arr);
//$res=$s->fetchAll();
/*if($s->rowCount() > 0)
{
    foreach($res as $res){

    echo $res['id'];
    }
    header("Location: register.php?bad=2");
    exit(0);
}
$sql="insert into users (name,password,email) values (:t,:z,:p)";
$s=$dbc->prepare($sql);
$s->bindValue(':t',$name);
$s->bindValue(':z',$pass);
$s->bindValue(':p',$email);
$s->execute();
header("Location: login.php?succ=1");
exit(0);//http://130.240.200.85/d0018e/D0018E/registerCheck.php
//$res=$s->fetchAll();
//if($s->rowCount() > 0)
//{
//    foreach($res as $res)
   // }
//}
*/ 



/* $sql="select name from users where binary name=:u";
$s=$dbc->prepare($sql);
//$sql="insert into users (name,password) values (:u,:p)";
//$s=$dbc->prepare($sql);
$s->bindValue(":u",$name);
//$s->bindValue(":p",$pass);
$s->execute();
$res=$s->fetchAll();
if(s->rowCount() > 0)
{
    echo "2";
    header("Location: register.php?bad=2");
    exit(0);
}
echo "3";
$sql="insert into users (name,password,email) values (:t,:z,:q)";
$s=$dbc->prepare($sql);
$s->bindValue(":t",$name);
$s->bindValue(":z",$pass);
$s->bindValue(":q",$email);
$s->execute();
echo "4";
*/
//header("Location: login.php?succ=1");
//exit(0);





?>
