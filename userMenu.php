<?php 
session_start();
require_once("userProfile.php"); //
?>

<html>
    
    <head>
        <title> UserMenu </title>
        <link rel="stylesheet" type="text/css" href="style/userMenuStyling.css" />
    </head>

    <body> 
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
                    <hr>
                    <li class="submenu_item">
                        <form action="functionAddBalance.php" method='POST'>
                            <label> <i>* Add balance</i> </label>
                            <input type='text' name='balance'>
                            <input type="submit" name='submit_balance' value="update">
                        </form>
                    </li>
                    
                    <li class="submenu_item">
                        <form action='uploadProfileImage.php' method='POST' enctype='multipart/form-data'>
                            <label> <i>* Upload profile image:</i> </label>
                            <input type='file' name='file'>
                            <br>
                            <button type='submit' name='submit'>upload</button>
                        </form>  
                    </li>  
                    <hr> 
                    <li class="submenu_item">
                        <?php if(!(isset($_SESSION['username']))){
                                    echo "<a href='login.php'> Login </a>";
                               }
                               else{
                                    echo "<a href='logoutCheck.php'> Logout </a>";
                                } 
                         ?>               
                    </li>
                    
                </ul>
            </li>
        </ul>
    
    </body>
</html>
