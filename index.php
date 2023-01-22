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
            session_start();
             echo "logged in as: ";
             echo $_SESSION['username'];
            ?>        
        </div> 
    </body>
</html>
