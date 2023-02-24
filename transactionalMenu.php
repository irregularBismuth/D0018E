<?php

session_start();
require_once("transactionalHandler.php");

?>

<html>

    <head>
        <title> Transactional Cart Menu </title>
        <link rel="stylesheet" type="text/css" href="style/userMenuStyling.css" /> 
    </head>
    
    <body>
        <ul>
            <li>
                    <img class="'profileStyle" src="../images/cartIcon.png" />
                    <br>
                    Shopping Cart
                <ul>
                    <li class="submenu_item">
                        <?php echo "method call here for showing cart with products"; ?>
                        <?php echo "<form action=".$transactionalHandler->execTransaction().'"/>;'?>
                    </li>
                
                </ul>
            </li>
        </ul>
    
    </body>
</html>
