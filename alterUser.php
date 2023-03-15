<?php 
session_start();

$newUsername = $_POST['uname'];
$id = $_POST['hid'];

$dll="select * from users";
$sqlHandler->half_genericQuery($dll,0,0);
$w=$sqlHandler->s->fetchAll();

foreach($w as $w){

if($newUsername==$w['name'])
{    // already exist

}
}

//om inte finns ändra user name med ny query where id = $id;
//
//
if((isset($_SESSION['username']))){

header("Location: superProfile.php");
exit(0);
}
else {

header("Location: superProfile.php?bad=1");
exit(0);
}

?>
