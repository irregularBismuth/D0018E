<?php
session_start();
$id=$_POST['hid'];

$link="delete from users where id=:x";
$sqlHandler->half_genericQuery($link,1,array($id));
header("Location: superProfile.php?succ=2");
exit(0);

?>
