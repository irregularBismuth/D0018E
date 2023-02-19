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
        <nav>
        <ul>
            Items here....?
            <li>
                <img src="" class="profileStyle" />
                <ul>
                    <li class="submenu_item">
                        <span class="menu_icons">Item1</span>
                        <p> Test </p>
                    </li>
                </ul>
            </li>
        </ul>
        </nav>

        <?php                                          
            echo "<form action='uploadProfileImage.php' method='POST' enctype='multipart/form-data'>
                        <input type='file' name='file'>
                        <button type='submit' name='submit' > upload image </button>
                    </form>";  
            echo $userProfile->getSessionData()['name'];   

            echo $userProfile->getSessionData()['balance'];            
        
            echo "<img src=.".$userProfile->getSessionData()['profileImage']">";            
        ?>
    
    </body>
</html>
