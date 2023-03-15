<?php 
session_start();

$newUsername = $_POST['uname'];
$id = $_POST['hid'];

$dll="select * from users";
$sqlHandler->half_genericQuery($dll,0,0);
$w=$sqlHandler->s->fetchAll();
$ss=0;
if($sqlHandler->s->rowCount() > 0){

    foreach($w as $w){

            if($newUsername==$w['name'])
            {    // already exist
                $ss=1;
            }
    }

//om inte finns ändra user name med ny query where id = $id;
//
//
    if($ss==1){

     header("Location: superProfile.php?bad=1");
     exit(0);
    }

$milker="update users set name=`:x` where id=:y";
//$link="update users set name=:x where id=:y";
$sqlHandler->half_genericQuery($milker,2,array($newUsername,$id));
header("Location: superProfile.php?succ=3");
exit(0);
}
?>
