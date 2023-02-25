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
                    <img class="'profileStyle" src="../images/cartIcon.png" width="100px" height="100px" />
                    <br>
                    Shopping Cart
                <ul>
                    <li class="submenu_item">
                        <span class="menu_icons"> </span>
                        <p> <b>Session id: </b> </p>
                    </li>
                    <hr>
                    <br>
                
                </ul>
            </li>
        </ul>
    
    </body>
</html>
