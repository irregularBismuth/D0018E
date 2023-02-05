<!DOCTYPE html>
<?php
session_start();
require_once("sqlHandler.php");
require_once("userProfile.php");
?>
<html>

    <head>
    <link
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
        Hello: <?php echo $userProfile->getSessionData("name");?>
        <br>
        <img src="balanceIcon.png" width="50" height="50"> 
        Balance: MAKE QUERY HERE!     
        
    </div>

    
        <?php
            //code heresadasdas
        ?>

    </body>
</html>


