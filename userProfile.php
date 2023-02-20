<?php 
session_start();
require_once("sqlHandler.php");
$sql = $sqlHandler;
$userProfile = new UserProfile($sql);
?> 

<?php
    class UserProfile{
        private $balance;
        private $profileImage;
        private $username;
        private $user_id;
        private $cart_items_added;
        private $userData;
        private $sqlController; 
        
        function __construct($sqlObject)
        {
           session_start(); 
           $this->user_id = $_SESSION['id'];
           $this->username = "";
           $this->balance = "";
           $this->profileImage = "../images/default_profile_image.png";
           $this->sqlController = $sqlObject;
           $this->userData = array("name"=>$this->username,"balance"=>$this->balance,"profileImage"=>$this->profileImage);//$this->username,"balance"=>$this->balance,"profileImage"=>$this->profileImage);
            $this->fetchUserData();
            // FIX: set the global session variables in the function below!
        }

        
        function fetchUserData(){
            
                if (isset($_SESSION['id'])){
                    
                    $this->user_id = $_SESSION['id'];

                    $sql_query = "SELECT * FROM users where id=:x";
                    $temp_array = array($this->user_id);
                    $this->sqlController->half_genericQuery($sql_query, 1, $temp_array);
                    $output = $this->sqlController->s->fetchAll();
                    foreach($output as $output){ 
                        
                        $this->username = $output['name'];
                        $this->balance = $output['balance'];
                        $this->profileImage = $output['profileImage'];
                        $this->userData["name"] = $this->username;
                        $this->userData["balance"] = $this->balance;
                        $this->userData["profileImage"] = $this->profileImage;
                    }
                }
                else{
                    $this->userData = [];
                }
        }

        function getSessionData(){
                
                
            if ($this->userData == []){
                return $this->userData;
            }

            else{
                    return $this->userData; 
                }
            
        }


        function setProfileImage(){
            //For setting the profile image need to access the sqlHandler class for INSERT query. 
        }
        
        function addBalance($new_balance_amount){
            // adding balance that is initially 0, need to make INSERT query from sqlHandler!
            
            if(isset($_POST['submit_balance'])){
                $current_balance = $this->balance;
                $new_balance = $new_balance_amount + $current_balance;                           

                $sql_update_query = "UPDATE users SET balance=:x where id=:y";
                $temp_array = array($new_balance,$this->user_id);
                $this->sqlController->half_genericQuery($sql_update_query, 2, $temp_array);
                $execution = $this->sqlController->s->prepare($sql_update_query);
                $execution->execute();                        
                   
                $this->balance = $execution['balance'] + $new_balance;
                $this->userData["balance"] = $this->balance; 
                header("Refresh:0; url=userMenu.php"); 
                                           
            } 
        }

        function changeProfileImage(){
            // This will change the profile image by UPDATE query from sqlHandler! 
            
        }
    }
?>

