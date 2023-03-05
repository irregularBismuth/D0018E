<?php 
session_start();
require_once("transactionalHandler.php");

if (isset($_SESSION['product_cart'])){
    $transactionalHandler->generateCartDisplay();
}

?>
