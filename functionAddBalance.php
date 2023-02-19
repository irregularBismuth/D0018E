<?php 
session_start();
require_once("userProfile.php");
$balance_to_add = $_POST['balance'];
$userProfile->addBalance($balance_to_add);

header("Location: userMenu.php?success=1");


?>
