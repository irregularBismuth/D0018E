<?php 
session_start();

$newUsername = $_POST['uname'];
$id = $_POST['hid'];

$dll="select * from users";
$sqlHandler->half_genericQuery($dll,0,0);
$w=$sqlHandler->s->fetchAll();
$s=0;
foreach($w as $w){

if($newUsername==$w['name'])
{    // already exist
    $s=1;
}
}

//om inte finns ändra user name med ny query where id = $id;
//
//
if($s==1){

header("Location: superProfile.php?bad=1");
exit(0);
}

?>
