<?php 
session_start();
require_once("userProfile.php");
?>

<html>
    
    <head>
        <title> UserMenu </title>
        <link rel="stylesheet" type="text/css" href="style/userMenu.css" />
    </head>

    <body> 
        test 123
        <?php 
                                           
            echo "<form action='uploadProfileImage.php' method='POST' enctype='multipart/form-data'>
                        <input type='file' name='file'>
                        <button type='submit' name='submit' > upload image </button>
                    </form>";              
        ?>
        
    </body>

</html>
