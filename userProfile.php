<?php 
session_start();
//require_once("sqlHandler.php"); /////
?> 

<?php
    class UserProfile{
        private $balance;
        private $profileImage;
        private $username;
        private $user_id;
        private $cart_items_added;
        public $userData; 
        
        function __construct()
        {
           session_start(); 
            if(!(isset($_SESSION['id']))){
            
            }
            else {
            $this->user_id = $_SESSION['id']; 
            }  
        //  $this->userData = array("name"=>"","username"=>"","balance"=>"","profileImage"=>"");//$this->username,"balance"=>$this->balance,"profileImage"=>$this->profileImage);
            $this->empty();

            // FIX: set the global session variables in the function below!
        }
        function empty() {
        session_start();
        require_once "sqlHandler.php";
        } 
        function fetchUserData(){
            session_start();
            require_once("sqlHandler.php");
            
            //try{
                
               /* 
                if (isset($_SESSION['id'])){
                    
                    $this->user_id = $_SESSION['id'];

                    $sql_query = "SELECT * FROM users where id=:x";
                    $temp_array = array($this->user_id);
                    $sqlHandler->half_genericQuery($sql_query, 1, $temp_array);
                    $output = $sqlHandler->s->fetchAll();
                    foreach($output as $output){ 
                        
                        $this->username = $output['name'];
                        $this->balance = $output['balance'];
                        $this->profileImage = $output['profileImage'];
                        array_push($this->userData["name"], $output["name"]);
                        array_push($this->userData["balance"], $output["balance"]);
                        array_push($this->userData["profileImage"], $output["profileImage"]);
                    }
                }
                else{
                    $this->userData = [];
                }
            //}
           // catch(Exception $e){
            //    echo $e->getMessage();
           // }*/
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

