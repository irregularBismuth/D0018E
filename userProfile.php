<?php 
session_start();
//require_once("sqlHandler.php");
?> 

<?php
    class UserProfile{
        private $balance;
        private $profileImage;
        private $username;
        private $user_id;
        private $cart_items_added;
        public $userData;
        public $sqlHandler; 
        
        function __construct()
        {
           session_start(); 
           $this->user_id = $_SESSION['id'];
           $this->sqlHandler = $this->getSqlHandler();
           $this->userData = array("name"=>"","username"=>"","balance"=>"","profileImage"=>"");//$this->username,"balance"=>$this->balance,"profileImage"=>$this->profileImage);
            $this->fetchUserData();
            // FIX: set the global session variables in the function below!
        }

        function getSqlHandler(){
            require_once("sqlHandler.php");
            return $sqlHandler;
        }
        
        function fetchUserData(){
            
                if (isset($_SESSION['id'])){
                    
                    $this->user_id = $_SESSION['id'];

                    $sql_query = "SELECT * FROM users where id=:x";
                    $temp_array = array($this->user_id);
                    $this->sqlHandler->half_genericQuery($sql_query, 1, $temp_array);
                    $output = $this->sqlHandler->s->fetchAll();
                    foreach($output as $output){ 
                        
                        //$this->username = $output['name'];
                        //$this->balance = $output['balance'];
                        //$this->profileImage = $output['profileImage'];
                        $this->userData["name"] = $output["name"];
                        $this->userData["balance"] = $output["balance"];
                        $this->userData["profileImage"] = $output["profileImage"];
                    }
                }
                else{
                    $this->userData = [];
                }
        }

        function getSessionData(){
                
                
            if ($this->userData == []){
                return "Login to see info!";
            }

            else{
                    return $this->userData; 
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

