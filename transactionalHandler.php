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
                $_SESSION['product_cart'] = array_unique($_SESSION['product_cart']); // removing duplicates
                $this->product_cart = $_SESSION['product_cart'];

                //INSERT META DATA HERE FOR TRANSACTIONAL TABLE

            }

            header('location: '.$_SERVER['REQUEST_URI']); 
        }
    }

    function checkProductQuantity(){
        
    }
    
    function generateCartDisplay(){
        
        if(isset($_SESSION['product_cart'])){
            $product_ids = $_SESSION['product_cart'];

            //$this->updateCartDisplay($_POST['product_id_cart']); 
           
            $subtotal = 0;
            foreach($product_ids as $product_id){
                $product_data = $this->getProductData($product_id)[0]; // check the [0] index! 
                $subtotal += $product_data['animal_price']; 
                $product_quantity = $product_data['animal_quantity'];
                echo '<pre>';
                //echo $product_id;
                echo '<li class="submenu_item">';
                echo '<img class="submenu_item" src='.$product_data["animal_image"].'>';
                echo '<p> product: '.$product_data["animal_name"].'</p>';
                echo '|';
                echo '<br>';
                echo '<p> price: '.$product_data["animal_price"].'¥</p>';
                echo '|';
                echo '<p> total: '.$product_data["animal_price"]*$product_quantity.'¥</p>';
                echo '<br>';
                echo '<li class="submenu_item">';
                echo '<form style="display: block; background-color: inherit;" method="POST">';
                echo '<input type="hidden" name="product_id_cart" value='.$product_data["animal_id"].' />';
                echo '<input type="number" name=product_quantity value="1" max='.$product_quantity.'min="1"/>';
                echo '</li>';
                echo '<li class="submenu_item">';
                echo '<button type="submit" name="removeButton" value="remove">';
                echo '<img src=../images/remove_icon.jpg>';
                echo '</button>';
                echo '<button type="submit" name="addQuantity" value="addquantity">';
                echo '<img src=../images/add_icon.png>';
                echo '</button>';
                echo '</li>';
                echo '</form>';
                echo '<li class="submenu_item">';
                echo '<p>Stock quantity: '.$product_quantity.'</p>';
                echo '</li>';
                //echo '<hr>';
                echo '<br>';
                echo '</li>';
                echo '</pre>';
            }

            $_SESSION['product_total'] = $subtotal;
            $this->updateCartDisplay($_POST['product_id_cart']); 

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

        //$this->checkoutOrderPlaced();
    }

    public function checkoutOrderPlaced(){
        //1. Need to be logged in to place order - CHECK
        if(isset($_POST['checkoutButton'])){

            if(!isset($_SESSION['id'])){
                echo "<p>Need to login to complete purchase!</p>";
                echo '<a href="login.php"> Login here! </a>';
            }

            else if (isset($_SESSION['id'])) {
                //2. EXEC TRANSACTION 
                $this->execTransaction($_SESSION['id'],$_SESSION['product_cart'], $_SESSION['product_total']); 
            }
          
        }

    }

    public function insertTransactionalMetadata($userid){
            $sql_metadata_transactional = "INSERT INTO transactional (shoppingCart_bool, customer_id, transactional_amount, comment) VALUES (:x, :y, :z, :w)"; 
            $t_param = array(0, $userid, 0, "no status");
            $output = $this->sqlConnector->half_genericQuery($sql_metadata_transactional, 4, $t_param);
            $output->s->execute();
    }
    
    public function execTransaction($userid, $product_ids, $total_amount){
        /* TRANSACTION PERFORMED WHENEVER CHECKOUT BUTTON IS PRESSED */
            $sqlTransaction = $this->sqlConnector->get_db_connector();
            
            try {
                //$sqlTransaction->exec('PRAGMA foregin_keys = ON');
                $sqlTransaction->beginTransaction();

                //###############################################################################
                $this->insertTransactionalMetadata($userid);
                $this->sqlConnector->s->closeCursor();
                
                // CHECK IF BALANCE IS ENOUGH!  
                $query_balance = "SELECT balance FROM users WHERE id=:x";
                $userid_param = array($userid);
                $this->sqlConnector->half_genericQuery($query_balance, 1, $userid_param);

                $current_balance = $this->sqlConnector->s->fetchColumn();
                $this->sqlConnector->s->closeCursor();;
                                
                $transactional_amount = $total_amount;
                $transaction_comment = "order confirmed!";

                if ($current_balance < $transactional_amount){
                    $transaction_comment = "not enough money, add more!";
                    //echo "<p>".$transaction_comment."</p>";
                    return false;  
                }

                //###############################################################################
                $query_order_id = "SELECT order_id FROM transactional WHERE customer_id=:x";
                $this->sqlConnector->half_genericQuery($query_order_id, 1, $userid_param);         
                $session_order_id = $this->sqlConnector->s->fetchColumn();
                $this->sqlConnector->s->closeCursor();;

                foreach($product_ids as $product_id){
                    $product_data = $this->getProductData($product_id)[0]; 
                    $animal_id = $product_data['animal_id'];

                    $sql_order_info = "INSERT INTO order_info SET order_id=:x, product_id=:y";
                    $query_remove = "DELETE FROM animals WHERE animal_id=:x";
                    $order_param = array($session_order_id, $animal_id);
                    $remove_param = array($animal_id);
                    $this->sqlConnector->half_genericQuery($sql_order_info, 2, $order_param);
                    $this->sqlConnector->s->execute();
                    $this->sqlConnector->s->closeCursor();;
                    $this->sqlConnector->half_genericQuery($query_remove, 1, $remove_param);
                    $this->sqlConnector->s->execute();
                    $this->sqlConnector->s->closeCursor();;
                }

                //###############################################################################
                $sql_update_transaction = "UPDATE transactional SET shoppingCart_bool=:x, transactional_amount=:y, comment=:z" ;                
                $transac_param = array(1, $transactional_amount, $transaction_comment);
                $this->sqlConnector->half_genericQuery($sql_update_transaction, 2, $transac_param);
                $this->sqlConnector->s->execute();
                $this->sqlConnector->s->closeCursor();;

                //###############################################################################
                $updated_balance = $current_balance - $total_amount;
                $sql_subtract_balance = "UPDATE users SET balance = :x WHERE id =:y";
                $balance_param = array($updated_balance, $userid);
                $this->sqlConnector->half_genericQuery($sql_subtract_balance, 2, $balance_param);
                $this->sqlConnector->s->execute();

                //###############################################################################
                
                $sqlTransaction->commit();
                
            } catch (PDOException $e){

                $sqlTransaction->rollback();
                echo "<p>".$transaction_comment."</p>";
                die($e->getMessage());
            }
    } 
}
?>
