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
                    <img class="'profileStyle" src="../images/cartIcon.png" width="75px" height="75px" />
                    <br>
                    Shopping Cart
                <ul>
                    <?php 
                        $transactionalHandler->generateCartDisplay();
                    ?>
                
                </ul>
                Checkout here
            </li>
        </ul>
    
    </body>
</html>
