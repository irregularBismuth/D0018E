<?php
session_start();
<<<<<<< HEAD
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

=======
function checkSession(){
 
    if(!(isset($_SESSION['id']))){
        header("Location: login.php");
        exit(0);
    }
    else{
        $site_url = "http://130.240.200.85/d0018e/D0018E/site.php";
        header("Location: productPage.php");
        exit(0);
        //adahsduggrsh
    }
    
>>>>>>> 03fa6cd1c50c647db3b8fad79d9e8657c0a72323
}
//peepo test
?>
