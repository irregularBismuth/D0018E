<?php
session_start();
require_once "checkSession.php";
checkSession();

//echo "hello world";
//abc


?>

<html>
    <head>
    </head>
    <body>
        <div>
            <?php
             echo "logged in as: ".$_SESSION['username'];
            ?>        
        </div> 
    </body>
</html>
