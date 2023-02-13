<?php
session_start();
function checkSession()
{
 if(!(isset($_SESSION['username'])))
 {
   header("Location: login.php");
   exit(0);
 }
 else{
    header("Location: site.php");
    exit(0);
}
} 
//peepo test
?>
