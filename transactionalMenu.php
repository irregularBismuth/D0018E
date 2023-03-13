<?php

session_start();
include("transactionalHandler.php");

?>

<html>

    <head>
        <title> Transactional Cart Menu </title>
        <link rel="stylesheet" type="text/css" href="style/userMenuStyling.css" />

        <style> 
            form {display: block; }
        </style> 
    </head>
    
    <body>
        <ul>
            <li>
                    <img class="'profileStyle" src="../images/cartIcon.png" width="75px" height="75px" />
                    <br>
                    Shopping Cart
                <ul>
                    <?php $transactionalHandler->generateCartDisplay();?>
                    <hr>
                    
                    <?php $transactionalHandler->checkoutForm();?>
                </ul>
                
            </li>
        </ul>
    
    </body>
</html>
