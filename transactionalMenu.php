<?php

session_start();
require_once("transactionalHandler.php");

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

                   <b> <?php echo 'subtotal: <p>'.$_SESSION['product_total'].'</p>' ?></b>
                    
                    <?php $transactionalHandler->checkoutForm();?>       
                </ul>
                
            </li>
        </ul>
    
    </body>
</html>
