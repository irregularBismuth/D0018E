<?php
session_start();
function checkSession(){
 
    if(!(isset($_SESSION['id']))){
        header("Location: login.php");
        exit(0);
    }
    else{
        $site_url = "http://130.240.200.85/d0018e/D0018E/site.php";
        header("Location: ".$site_url, true, 301);
        exit(0);
    }
    
}
?>
