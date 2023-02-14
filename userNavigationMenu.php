<!DOCTYPE html>
<?php
session_start();
require_once("sqlHandler.php");
require_once("userProfile.php");
?>

<html>

    <head>
        <title> User navigation menu </title>
        <link rel="stylesheet" type="text/css" taget="cartPage" href="style/shoppingCartStyle.css"/>
        <link rel="stylesheet" type="text/css" href="style/style.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="style/userMenu.css"/>
    </head>

    <body>

        <div class="dropdownMenu">

                <?php 
                    echo "Profile info: ".$_SESSION['username']
                ?> 
            
        </div>                            
    
    </body>
</html>


