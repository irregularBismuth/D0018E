<?php 
session_start();
require_once("userProfile.php");
$userProfile->addBalance($_POST['balance']);
?>

<html>
    
    <head>
        <title> UserMenu </title>
        <link rel="stylesheet" type="text/css" href="style/userMenuStyling.css" />
    </head>

    <body> 
        <nav>
        <ul>
            <li>
            <?php echo '<img class="profileStyle" src="'.$userProfile->getSessionData()['profileImage'].'" />'; ?>
                <ul>
                    <li class="submenu_item">
                        <span class="menu_icons"></span>
                        <p> Name: <?php echo $userProfile->getSessionData()['name'] ?> </p>
                    </li>
                    
                    <li class="submenu_item">
                        <span class="menu_icons"> </span>
                        <p> Balance: <?php echo $userProfile->getSessionData()['balance'] ?> </p>
                    </li>

                    <li class="submenu_item">
                        <form action="userProfile.php" method='POST'>
                            <label> Add balance </label>
                            <input type='text' name='balance'>
                            <input type="submit" name='submit_balance'>
                        </form>
                    </li>
                    
                    <li class="submenu_item">
                        <form action='uploadProfileImage.php' method='POST' enctype='multipart/form-data'>
                            <label> Upload profile image: </label>
                            <input type='file' name='file'>
                            <button type='submit' name='submit' > upload image </button>
                        </form>  
                    </li>                  

                </ul>
            </li>
        </ul>
        </nav>       
    
    </body>
</html>
