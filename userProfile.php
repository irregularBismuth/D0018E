<?php 
session_start();
require_once("sqlHandler.php");
?> 

<?php
    class UserProfile{
        private $balance;
        private $profileImage;
        private $username;
        private $user_id;
        private $cart_items_added;
        
        function __construct()
        {
            $this->user_id = $_SESSION['user_id'];
            $this->username = $this->fetchUserData('name');
            $this->balance = $this->fetchUserData('balance');
            $this->profileImage = $this->fetchUserData('profile_image');   
        }
        
        function fetchUserData($col_name){
            require_once("sqlHandler.php");
            
            $sql_query = "SELECT * FROM users where id=:x";
            $temp_array = array($this->user_id);
            $sqlHandler->half_genericQuery($sql_query, 1, $temp_array);
            $output = $sqlHandler->s->fetchAll();
            return $output[$col_name];
        }

        function getSessionData($stringFlag=""){
            if ($stringFlag == "user_id"){
                return $this->user_id;
            }
            
            if ($stringFlag == "name"){          
                return $this->username;
            }
            if ($stringFlag == "balance"){
                return $this->balance;
            }
            
            if ($stringFlag == "profile_image"){
                return $this->profileImage;
            }

            else{
                return null; 
            }
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
    $userProfile = new UserProfile();
?>

