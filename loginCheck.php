<?php
session_start();
require_once "db/db.php";
//require_once("classes/accountHandler.php");
$uname=$_POST['uname'];
echo $uname;
$passw=$_POST['passw'];
$sql="select * from users where binary name=:username and binary password=:password";
$s->bindValue(":username","C.lay");
$s->bindValue(":password","lin alg");
$s->execute();
$result=$s->fetchAll();
print_r($result);


//echo $uname;
//echo $passw;



//loginFunc($uname,$passw);
//if(isset($_SESSION['username']))

 // header("Location: index.php");
 // exit(0);
//}
//header("Location: login.php?bad=1");
//exit(0);


?>
