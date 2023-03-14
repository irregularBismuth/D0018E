<?php
session_start();
$who=$_POST['who'];

header("Location: page.php?a=".$who);
exit(0);

?>
