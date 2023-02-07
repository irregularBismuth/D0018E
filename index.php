<?php
session_start();
require_once "checkSession.php";
checkSession();

//echo "hello world";
//abc


?>

<html>
    <head>
        <title>
            index
        </title>
    </head>
    <body>
        <div>
            <?php
            session_start();
             echo "logged in as: ";
             echo $_SESSION['username']."</br>";
             echo $_SESSION['id']."</br> 123";
            ?>        
        </div> 
    </body>
</html>
