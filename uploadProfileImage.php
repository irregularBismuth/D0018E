<?php 
session_start();
require_once 'sqlHandler.php';
$current_id = $_SESSION['id'];

if (isset($_POST['submit'])){
    $file = $_FILES['file'];
}
?>
