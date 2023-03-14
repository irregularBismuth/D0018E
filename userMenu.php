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
            <?php echo '<img class="profileStyle" src="'.$userProfile->getSessionData()['profileImage'][0].'" />'; ?>
                <br>
                Profile
                <ul>
                    <li class="submenu_item">
                        <span class="menu_icons"></span>
                        <p> <b>Name:</b> <?php echo $userProfile->getSessionData()['name'][0] ?> </p>
                    </li>
                    
                    <li class="submenu_item">
                        <span class="menu_icons"> </span>
                        <p> <b>Balance:</b> <?php echo $userProfile->getSessionData()['balance'][0] ?> </p>
                    </li>
                    <hr>
                    <br>
                    <li class="submenu_item">
                        <form method='POST'>
                            <p>
                            <label> <i>* Add balance</i> </label>
                            <input type='text' name='balance'>
                            <input type="submit" name='submit_balance' value="update">
                            </p>
                        </form>
                    </li>
                   <br> 
                    <li class="submenu_item">
                        <form action='uploadProfileImage.php' method='POST' enctype='multipart/form-data'>
                            <p>
                            <label> <i>* Upload profile image:</i> </label>
                            <input type='file' name='file'>
                            <br>
                            <button type='submit' name='submit'>upload</button>
                            </p>
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
