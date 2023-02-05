<!DOCTYPE html>
<?php
session_start();
require_once("sqlHandler.php");
require_once("userProfile.php");
?>
<html>

    <head>
        <link rel="stylesheet" type="text/css", href="shoppingCartStyle.css"/>
        <link rel="stylesheet" type="text/css", href="style.css" media="screen"/>

     <title> User navigation menu </title>
    
    </head>

    <body>
        <div class="headern">
            <a href="site.php">
                <img src="logo.png" width="400">
            </a>
        </div>
        <div id="CustomSidePanel" class="UserSidePanel">

            <!-- <img src="PHPQUERY TO GET PROFILE IMG"> -->
            <br>
            <ul id="infoSection">

                <li> Hello: <?php echo $userProfile->getSessionData("name");?> </li>
            </ul>
            <br>
            Balance: <img src="balanceIcon.png" width="50" height="50"/>                
        </div>

    </body>
</html>


