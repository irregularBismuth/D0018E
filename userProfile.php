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
           $this->profileImage = "";
           $this->cart_items_added = array();
           $this->sqlController = $sqlObject;
           $this->userData = array("name"=>$this->username,"balance"=>$this->balance,"profileImage"=>$this->profileImage);//$this->username,"balance"=>$this->balance,"profileImage"=>$this->profileImage);
            //$this->fetchUserData();
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
                    $this->userData["name"] = $this->username;
                    $this->userData["balance"] = $this->balance;
                    $this->userData["profileImage"] = "../images/defaultProfileImage.png";
                }
        }

        function checkIfUserIdSet(){
            if (!isset($_SESSION['id'])){
                return false;
            }
            else{return true;} 
        }

        function getSessionData(){
            
            //require_once("transactionalHandler.php");
            
                
            $query = "SELECT * FROM users where id=:x";
            $this->sqlController->half_genericQuery($query, 1, array($_SESSION['id']));
            $output = $this->sqlController->s->fetchAll();                      
            $this->userData["name"] = $output['name'];
            $this->userData["balance"] = $output['balance'];
            $this->userData['profileImage'] = $output['profileImage'];
             
            return $output;
            
        }


        function setProfileImage(){
            //For setting the profile image need to access the sqlHandler class for INSERT query. 
        }
        
        function addBalance(){
            // adding balance that is initially 0, need to make INSERT query from sqlHandler!
            
            if(isset($_POST['submit_balance'])){

                $query = "select balance from users where id=:x";
                $this->sqlController->half_genericQuery($query, 1, array($_SESSION['id']));
                $output = $this->sqlController->s->fetchAll();                      

                $current_balance = $output['balance'];
                $new_balance = $_POST['balance'] + $current_balance;                           

                $sql_update_query = "UPDATE users SET balance=:x where id=:y";
                $temp_array = array($new_balance,$_SESSION['id']);
                $this->sqlController->half_genericQuery($sql_update_query, 2, $temp_array);                      
                   
                header("Refresh:0; url=userMenu.php"); 
                                           
            } 
        }

        function changeProfileImage(){
            // This will change the profile image by UPDATE query from sqlHandler! 
            
        }
    }
?>

