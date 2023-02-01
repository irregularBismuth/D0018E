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
