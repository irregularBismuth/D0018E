<?php
session_start();
require_once("sqlHandler.php");
require_once("userProfile.php");
$sql = $sqlHandler;
$transactionalHandler = new TransactionalHandler($sql);
?>

<?php 
class TransactionalHandler{
    private $product_cart;
    private $sqlConnector;
    private $session_order_id;
    private $customer_id;
    private $product_id; 

    function __construct($sqlConnectorReference)
    {
        session_start();
        $this->product_cart = array();
        $this->sqlConnector = $sqlConnectorReference;
        $this->session_order_id = "";
        $this->customer_id = "";
        $this->product_id = array();
        //product_id and button_id... 
        
    }

    function checkCustomerId(){
        require_once("userProfile.php");
        session_start();
        
        if($userProfile->checkIfUserIdSet()){ 
            $_SESSION['customer_id'] = $_SESSION['id'];
            $this->customer_id = $_SESSION['id'];            
            
        }
        else {          
                $this->customer_id = session_create_id();
                $_SESSION['customer_id'] = $this->customer_id;
            }
    }

    function addButtonClickAction(){
        if(isset($_POST['addButton'])){

            $product_id = $_POST['product_id'];
            $this->product_id = $product_id;
            if(!isset($_SESSION['product_cart'])){
                $_SESSION['product_cart'] = array();
                $this->product_cart = $_SESSION['product_cart'];
            }
            
            if(isset($_SESSION['product_cart'])){
                array_push($_SESSION['product_cart'], $product_id);
                $this->product_cart = $_SESSION['product_cart'];
                //$this->products_added = array('animal_id' => $product_id);
            }

            header('location: '.$_SERVER['REQUEST_URI']); 
        }
    }
    
    function generateCartDisplay(){
        
        if(isset($_SESSION['product_cart'])){
            $product_ids = $_SESSION['product_cart'];

            $this->updateCartDisplay($_POST['product_id_cart']); 
           
            $subtotal = 0;
            foreach($product_ids as $product_id){
                $product_data = $this->getProductData($product_id)[0]; // check the [0] index! 
                $subtotal += $product_data['animal_price']; 
                echo '<pre>';
                //echo $product_id;
                echo '<li class="submenu_item">';
                echo '<img class="submenu_item" src='.$product_data["animal_image"].'>';
                echo '<p> product: '.$product_data["animal_name"].'</p>';
                echo '<br>';
                echo '<p> price: '.$product_data["animal_price"].'¥</p>';
                echo '<br>';
                echo '<form style="display: block; background-color: inherit;" method="POST">';
                echo '<input type="hidden" name="product_id_cart" value='.$product_data["animal_id"].' />';
                echo '<button style="border-radius: 50%; padding: 20px; font-size: 15px;" type="submit" name="removeButton" value="remove"> remove';
                echo '</button>';
                echo '</form>';
                echo '<hr>';
                echo '<br>';
                echo '</li>';
                echo '</pre>';
            }
            $_SESSION['product_total'] = $subtotal;
            //$this->updateCartDisplay($_POST['product_id_cart']); 

        }
        
    }

    function getProductData($product_id){
        $query = "SELECT * FROM animals where animal_id=:x";
        $param_array = array($product_id);
        $this->sqlConnector->half_genericQuery($query, 1, $param_array);
        $output = $this->sqlConnector->s->fetchAll();
        return $output; 
    }
    
    function updateCartDisplay($product_id_to_remove){
        if (isset($_POST['removeButton'])){
            $item_to_remove = array_search($product_id_to_remove, $_SESSION['product_cart']);
            unset($_SESSION['product_cart'][$item_to_remove]);
            $this->product_cart = $_SESSION['product_cart'];
            //$this->generateCartDisplay();
            header('location: '.$_SERVER['REQUEST_URI']); 
        }
    }
    
    function checkoutForm(){
        echo '<form style="display: block; background-color: inherit" class="submenu_item" method="POST">';     
        echo '<button type="submit" name="checkoutButton" value="checkout" >checkout ';
        echo '</button>';
        echo '</form>'; 
        $this->checkoutOrderPlaced();
    }

    function checkoutOrderPlaced(){
        //1. Need to be logged in to place order - CHECK
        if(isset($_POST['checkoutButton'])){

            if(!isset($_SESSION['username'])){
                echo "<p>Need to login to complete purchase!</p>";
                echo '<a href="login.php"> Login here! </a>';
            }
            else {
            //2. insert metadata to transactional table

            }
        }
    }

    function insertMetadataNewOrder(){
        
    }
    
    function execTransaction(){
        /* If the add button form is pressed it should start a new transaction:
 
        - Add if else for checking if(isset($_SESSION['id'] is set = LOGGED IN!
                1. If logged in it should fetch/query transactional.product_id = user.id
                2. If not logged in it should check if(isset($_SESSION['order_id'] instead!
        */
    
            try {
                $sqlTransaction = $this->sqlConnector->get_db_connector();
                $sqlTransaction->exec('PRAGMA foregin_keys = ON');
                $sqlTransaction->beginTransaction();
                              
                $sql_transactional_query = "SELECT * FROM transactional JOIN animals ON transactional.product_id = animals.animal_id WHERE transactional.order_id =:x";
                $sql_query = "SELECT * FROM animals WHERE animal.animal_id =:x";
                $param_array = $this->product_cart;

                $this->sqlConnector->half_genericQuery($sql_query, 1, $param_array);
                $execution = $this->sqlConnector->s->execute();
    
                $sqlTransaction->commit();
                
            } catch (PDOException $e){
                $this->sqlConnector->get_db_connector()->rollback();
            }
    } 
}
?>
