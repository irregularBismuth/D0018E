<?php 
session_start();
require_once("sqlHandler.php");
?> 

<?php
    class userProfile{
        private $balance;
        private $profileImage;
        private $username;
        private $cart_items_added;
        
        function __construct()
        {
            $this->username = $_SESSION['username'];
            $this->balance = 0;
            $this->profileImage = "";   
        }
        
        function getUserData(){
            require_once("sqlHandler.php");
            $sql_query = "SELECT * FROM users where name=:x";
            $temp_array = array($this->username);
            $sqlHandler->half_genericQuery($sql_query, 1, $temp_array);
            echo $sqlHandler->s->fetchAll();
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

