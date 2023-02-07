<!-- <!DOCTYPE html> -->
<?php
session_start();
require_once("sqlHandler.php");
require_once("userProfile.php");
?>

<html>

    <head>
        <link rel="stylesheet" type="text/css" href="shoppingCartStyle.css"/>
        <link rel="stylesheet" type="text/css" href="style.css" media="screen"/>

     <title> User navigation menu </title>
    
    </head>

    <body>
        <div class="headern">
            <a href="site.php">
                <img src="logo.png" width="400">
            </a>
        </div>


            <!-- <img src="PHPQUERY TO GET PROFILE IMG"> -->
            <div class="infoStyle">
                <ul id="infoSection">
                    <li>
                        Name: <?php echo $userProfile->getSessionData("name"); ?>           
                    </li>

                    <li>  
                        Balance: 
                    </li>  

                </ul>
            </div>
                                
    </body>
</html>


