<?php 
session_start();
require_once("sqlHandler.php");
?> 

<?php
    class userProfile{
        private $balance;
        private $profileImage;
        
        function __construct()
        {
            $this->balance = 0;
            $this->profileImage = "";   
        }
        
        function setProfileImage(){
            //For setting the profile image need to access the sqlHandler class for INSERT query. 
        }
        
        function addBalance(){
            // adding balance that is initially 0, need to make INSERT query from sqlHandler! 
        }

        function changeProfileImage(){
            // This will change the profile image by UPDATE query from sqlHandler! 
            
        }
    }
?>

<html>

    <body>
        <form>action="userProfile.php" method="post">
        <img class="" src="">
        <?php echo $_GET["profileImage"] ?>
        <br>
        Welcome: <?php echo $_GET["name"]?>
        <br>
        Balance: <?php echo $_GET["balance"]?>
        <hr>
        Add balance: <input type="text" name="balance">
        </form>
    </body>
</html>
