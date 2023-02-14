<!-- <!DOCTYPE html> -->
<?php
session_start();
require_once("sqlHandler.php");
require_once("userProfile.php");
?>

<html>

    <head>
        <link rel="stylesheet" type="text/css" href="style/shoppingCartStyle.css"/>
        <link rel="stylesheet" type="text/css" href="style/style.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="style/userMenu.css"/>

     <title> User navigation menu </title>
    
    </head>

    <body>
        <div class="headern">
        <header>
            <a href="site.php">
                <img src="../images/logo.png" width="400">
            </a>

            <?php echo "Profile info: ".$_SESSION['username'] ?>
            
            <div class="dropdownMenu">
                TEST
            </div>       
                    
        </header>
        </div>
                                
    </body>
</html>


