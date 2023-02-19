<?php 
session_start();
require_once("userProfile.php");
?>

<html>
    
    <head>
        <title> UserMenu </title>
        <link rel="stylesheet" type="text/css" href="style/userMenuStyling.css" />
    </head>

    <body> 
        <nav>
        <ul>
            Items here....?
            <li>
            <?php echo '<img class="profileStyle" src="'.$userProfile->getSessionData()['profileImage'].'" />'; ?>
                <ul>
                    <li class="submenu_item">
                        <span class="menu_icons"></span>
                        <p> Name: <?php echo $userProfile->getSessionData()['name'] ?> </p>
                    </li>
                    
                    <li class="submenu_item">
                        <span class="menu_icons"> </span>
                        <p> Balance:<?php echo $userProfile->getSessionData()['balance'] ?> </p>
                    </li>
                    
                    <li class="submenu_item">
                        <form action='uploadProfileImage.php' method='POST' enctype='multipart/form-data'>
                            <input type='file' name='file'>
                            <button type='submit' name='submit' > upload image </button>
                        </form>  
                    <p> Upload profile image </p>
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
                    
        ?>
    
    </body>
</html>
