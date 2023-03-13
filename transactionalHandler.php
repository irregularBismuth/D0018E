<?php
session_start();
require_once("sqlHandler.php");
require_once("userProfile.php");
$sql = $sqlHandler;
$transactionalHandler = new TransactionalHandler($sql);
?>

<?php 
class TransactionalHandler{
    private $sqlConnector;

    function __construct(SQLHandler $sqlConnectorReference)
    {
        session_start();
        $this->sqlConnector = $sqlConnectorReference;
        //product_id and button_id...         
    }
 

    function addButtonClickAction(){
        require_once("sqlHandler.php");
        if(isset($_POST['addButton'])){

            $product_id = $_POST['product_id'];
            $query = "SELECT * FROM cart where customer_id=:x";
            $sqlHandler->half_genericQuery($query, 1, array($product_id));
            $output = $sqlHandler->s->fetchAll();
            
            if($sqlHandler->s->rowCount() > 0 ){
                $initid=0;
                foreach($output as $output){
                    $initid = $output['cart_id'];
                }
            }
            else{
                $query = "INSERT INTO cart(customer_id) VALUES(:x)";

                $sqlHandler->half_genericQuery($query, 1, array($product_id));

                $query = "SELECT * FROM cart where customer_id=:x";
                
                $sqlHandler->half_genericQuery($query, 1, array($product_id));

                $output = $sqlHandler->s->fetchAll();
                $cartid=0;
                $price=0;
                
                foreach($output as $output){
                    $cartid = $output['id'];
                }
                $query = "INSERT INTO cart_item(cart_id, product_id, quantity, price) VALUES(:x, :y, 1, :z)";
                $sqlHandler->half_genericQuery($query, 3, array($cartid, $product_id, $_POST['price']));
            } 

        }

        header('location: '.$_SERVER['REQUEST_URI']); 
    }
   
   /* function addButtonClickAction(){
        //session_start();
        if(isset($_POST['addButton'])){
            $product_id = $_POST['product_id'];


            $this->insertTransactionalMetadata($_SESSION['id']);
            $query_order_id = "SELECT * FROM transactional WHERE customer_id=:x";
            $this->sqlConnector->half_genericQuery($query_order_id, 1, array($_SESSION['id']));         
            $session_transactional = $this->sqlConnector->s->fetchAll(); 
            
            if(!isset($_SESSION['product_cart'])){
                
                $insert_query = "INSERT INTO order_info (order_id, product_id, order_quantity) VALUES (:x, :y, :z)";
                $param_insert = array($session_transactional['order_id'], $product_id, 1);
                $this->sqlConnector->half_genericQuery($insert_query, 3, $param_insert);

                $_SESSION['product_cart'] = array('product_id'=>$product_id, 'order_id'=>$session_transactional['order_id'] , 'order_quantity'=>1);
            }
            
            if(isset($_SESSION['product_cart'])){
                
                $animal_data = $this->getProductItems($product_id);
                
                if(in_array($product_id, $_SESSION['product_cart']['product_id']) && $_SESSION['product_cart']['order_quantity'] <= $animal_data['animal_quantity']){
                    
                    $update_quantity = $_SESSION['product_cart']['order_quantity'] + 1;
                    $update_query = "UPDATE order_info SET order_quantity=:x WHERE product_id=:y";
                    $param_update = array($update_quantity, $product_id);
                    $this->sqlConnector->half_genericQuery($update_query, 2, $param_update);
                    $_SESSION['product_cart']['order_quantity'] =  $update_quantity;
                }
     
                if(!in_array($product_id, $_SESSION['product_cart']['product_id'])){
                    
                    $insert_query = "INSERT INTO order_info (order_id, product_id, order_quantity) VALUES (:x, :y, :z)";
                    $param_insert = array($session_transactional['order_id'], $product_id, 1);
                    $this->sqlConnector->half_genericQuery($insert_query, 3, $param_insert);

                    $new_product = array('product_id'=>$product_id, 'order_id'=>$session_transactional['order_id'] , 'order_quantity'=>1); 
                    //$_SESSION['product_cart'] = array_push($_SESSION['product_cart']['product_id'], $product_id);
                    //$_SESSION['product_cart'] = array_push($_SESSION['product_cart']['order_id'], $session_transactional);
                    //$_SESSION['product_cart'] = array_push($_SESSION['product_cart']['order_quantity'], 1);
                    $_SESSION['product_cart'][] = $new_product; //[] means aepending to the array
                }

                //INSERT META DATA HERE FOR TRANSACTIONAL TABLE

            }

            
        } 
        
    }*/
    
    function generateCartDisplay(){
        
            /* 
            $query_order_id = "SELECT order_id FROM transactional WHERE customer_id=:x";
            $userid_param = array($_SESSION['id']);
            $this->sqlConnector->half_genericQuery($query_order_id, 1, $userid_param);         
            $session_order_id = $this->sqlConnector->s->fetch(PDO::FETCH_ASSOC);
            */

            require_once("sqlHandler.php");
                //adding some local variable reference:
                $query = "SELECT * FROM cart WHERE customer_id=:x";
                $sqlHandler->half_genericQuery($query, 1, array($_SESSION['id']));
                $output = $sqlHandler->s->fetchAll();
                $initid = 0;

                foreach($output as $output){
                    $initid=$output['id'];
                }

                $query = "SELECT * FROM animals, cart_item where cart_id=:x";
                $sqlHandler->half_genericQuery($query, 1, array($initid));
                $output = $sqlHandler->s->fetchAll();
                $tot=0;
                $subtotal = 0;

            foreach($output as $output){
                if($output['product_id'] == $output['animal_id']){
                    $tot = $output['price']*$output['quantity'];
                    }
                               
            
                $subtotal += $tot; 
                
                //echo var_dump($product_data);
                echo '<pre>';
                echo '<li class="submenu_item">';
                echo '<img class="submenu_item" src='.$output["animal_image"].'>';
                echo '<p> product: '.$output["animal_name"].'</p>';
                echo '|';
                echo '<br>';
                echo '<p> price: '.$output["animal_price"].'¥</p>';
                echo '|';
                echo '<p> total: '.$tot.'¥</p>';
                echo '<br>';
                echo '<li class="submenu_item">';
                echo '<form style="display: block; background-color: inherit;" method="POST">';
                echo '<input type="hidden" name="product_id_cart" value='.$output["animal_id"].' />';
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
                echo '<p>Stock quantity: '.$output['quantity'].'</p>';
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

    function getProductItems($product_id){
        $query = "SELECT * FROM animals WHERE animal_id=:x";
        $param_array = array($product_id);
        $this->sqlConnector->half_genericQuery($query, 1, $param_array);
        $output = $this->sqlConnector->s->fetchAll();
        return $output;  
    }

    function getProductCart($order_id){
        $query = "SELECT order_id FROM order_info WHERE order_id=:x";
        $param_array = array($order_id);
        $this->sqlConnector->half_genericQuery($query, 1, $param_array);
        $output = $this->sqlConnector->s->fetchAll();
        return $output; 
    }
    
    function updateCartDisplay($product_id_to_remove){
        if (isset($_POST['removeButton'])){
            $item_to_remove = array_search($product_id_to_remove, $_SESSION['product_cart']['product_id']);
            unset($_SESSION['product_cart']['product_id'][$item_to_remove]);
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

    function checkoutOrderPlaced(){
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

    function insertTransactionalMetadata($userid){
            $sql_metadata_transactional = "INSERT INTO transactional (customer_id, transactional_amount, comment) VALUES (:x, :y, :z)"; 
            $t_param = array($userid, 0, "no status");
            $this->sqlConnector->half_genericQuery($sql_metadata_transactional, 3, $t_param); 
    }
    
    function execTransaction($userid, $product_ids, $total_amount){
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
                    $product_data = $this->getProductCart($product_id)[0]; 
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
                die($e->getMessage());
            }
    } 
}
?>
