<?php 
session_start();
require_once("userProfile.php");
$balance_to_add = $_POST['balance'];
$userProfile->addBalance($balance_to_add);

if(isset($_POST['submit_balance'])){
    header("refresh: userMenu.php"); 
    exit(0); 
} 
?>
