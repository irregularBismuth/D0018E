<?php
session_start();
require_once "checkSession.php";
checkSession();

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
            //session_start();

             echo "logged in as: ";
             echo $_SESSION['username']."</br>";
             echo $_SESSION['id']."</br> 123";
            header("Location: site.php");
            
            ?>        
        </div> 
    </body>
</html>
