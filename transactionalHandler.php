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
        //require_once("sqlHandler.php");
        if(isset($_POST['addButton'])){
            //abcdefg
            //$product_id = $_POST['anmid'];
            $product_id = $_POST['product_id'];
            $initid=$this->getUserCartId()['id'];
            
            // if cart already exists then: 
            if($this->getUserCartId()->rowCount() > 0 ){
                
                $query = "SELECT * FROM cart_item where cart_id=:x";
                $this->sqlConnector->half_genericQuery($query, 1, array($initid)); 
                $out = $this->sqlConnector->s->fetchAll();
                $zz = 0; 
                $qq = 1; 
                $alread=0;
             
                foreach($out as $out){
                    if($out['product_id']==$product_id){
                        $zz = $out['id'];
                        $qq = $out['quantity'];
                        $alread = 1;
                    }
                }
                $qq+=1;
                if($alread){
                    $qr = "update cart_item set quantity=:x where id=:y";
                    $this->sqlConnector->half_genericQuery($qr, 2, array($qq, $zz));
                }
                else{
                    $quer = "INSERT INTO cart_item(cart_id, product_id, quantity, price) VALUES(:x, :y, :z)";
                    $this->sqlConnector->half_genericQuery($quer,3,array($initid, $product_id, $_POST['price']));
                }
                    //update quantity here:
                
            }

            // if cart doesnt exist we create a new one to the user:
            else{
                $query = "INSERT INTO cart(customer_id) VALUES(:x)";

                $this->sqlConnector->half_genericQuery($query, 1, array($_SESSION['id']));

                $cartid=$this->getUserCartId()['id'];
                
                $query = "INSERT INTO cart_item(cart_id, product_id, quantity, price) VALUES(:x, :y, 1, :z)";
                $this->sqlConnector->half_genericQuery($query, 3, array($cartid, $product_id, $_POST['price']));
            } 

            //header("Refresh:0");
            //header('location: productPage.php'); 
        }
        //header("Refresh:0");
        //header('location: productPage.php'); 
    }

    function getUserCartId(){
        //require_once("sqlHandler.php");
        $query = "SELECT * FROM cart where customer_id=:x";   
        $this->sqlConnector->half_genericQuery($query, 1, array($_SESSION['id']));
        $output = $this->sqlConnector->s->fetchAll();
        return $output;
 
    }

    function generateBoxFrames(){
                $query = "SELECT * FROM animals";
                $this->sqlConnector->half_genericQuery($query,0,0);
                $output = $this->sqlConnector->s->fetchAll();
                foreach($output as $output){
                    $product_id = $output['animal_id'];
                    //$product_quantity = $output['quantity'];
                    echo '
                        <div class="boxFrame">
                                <div class="section1">
                                        <img class="fit_image" src='.$output['animal_image'].'>
                                </div>
                                <div class="section2">
                                    <div class="infoStyle">
                                        <ul id="infoSection">
                                            <li>Product id: '.$output['animal_id'].' </li>
                                            <br>                             
                                            <li><b>Animal type:</b> '.$output['animal_name'].'</li>
                                            <br>
                                            <li><b>Stock quantity:</b> '.$output['animal_quantity'].'</li>
                                            <br>
                                            <hr>
                                            <li><b>Subtotal:</b> '.$output['animal_price'].'¥ </li>
                                            <br>
                                            <br>
                                            <li>
                                           <form action='.$this->addButtonClickAction().' method="POST">
                                                <input type="hidden" name="product_id" value='.$product_id.'> 
                                                <input type="hidden" name="price" value='.$output['animal_price'].'>
                                                <input type="submit" name="addButton" class="button" value="add" />   
                                                <a href=page.php?a='.$output['animal_id'].'>INFO</a>
                                                </form> 
                                            </li>
                                        </ul>
                                    </div>            
                                </div>
                               </div>
                                <br>    
                        </div>
                        <br>';
                    
                }
    }
    
    function generateCartDisplay(){
        
        //require_once("sqlHandler.php");
            //adding some local variable reference:
            
        $initid =0;
        foreach($this->getUserCartId() as $output){
            $initid = $output['id'];
        }

        //$query = "SELECT * FROM cart_item JOIN animals ON cart_item.product_id = animals.animal_id WHERE cart_id=:x";
        $query = "select * from animals,cart_item where cart_id=:x";
        $this->sqlConnector->half_genericQuery($query, 1, array($initid));
        $output = $this->sqlConnector->s->fetchAll();
        $tot=0;
        $subtotal = 0;
        //echo var_dump($output);

        foreach($output as $output){

            if ($output['product_id'] == $output['animal_id']){
            $tot = $output['price']*$output['quantity'];                 
            $subtotal += $tot;  

            echo '<pre>';
            echo '<li class="submenu_item" >';
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
            echo '<p>Quantity in cart: '.$output['quantity'].'</p>';
            echo '</li>';
            echo '<br>';
            echo '</li>';
            echo '</pre>'; 
            }   
        }
        echo $subtotal;
        // STOCK QUANTITY
        //$this->updateCartDisplay($_POST['product_id_cart']);      
    }
     
    function updateCartDisplay($product_id_to_remove){
        if (isset($_POST['removeButton'])){
            $initid =0;
            foreach($this->getUserCartId() as $output){
                $initid = $output['id'];
            }

            // DELETE AND CHECK IF QUANTITY IS BIGGER THAN 1 THEN REMOVE ONE QUANTITY ELSE REMOVE ITEM FROM CART

            //$query = "SELECT * FROM cart_item JOIN animals ON cart_item.product_id = animals.animal_id WHERE cart_id=:x";
            $query = "delete from cart_item where product_id=:x";
            $this->sqlConnector->half_genericQuery($query, 1, array($product_id_to_remove));
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

            if(!isset($_SESSION['id'])){
                echo "<p>Need to login to complete purchase!</p>";
                echo '<a href="login.php"> Login here! </a>';
            }

            else if (isset($_SESSION['id'])) {
                //2. EXEC TRANSACTION 
                //$this->execTransaction($_SESSION['id'],$_SESSION['product_cart'], $_SESSION['product_total']); 
            }
          
        }

    }

    function insertTransactionalMetadata($userid){
            $sql_metadata_transactional = "INSERT INTO transactional (customer_id, transactional_amount, comment) VALUES (:x, :y, :z)"; 
            $t_param = array($userid, 0, "no status");
            $this->sqlConnector->half_genericQuery($sql_metadata_transactional, 3, $t_param); 
    }

    /*
    function execTransaction($userid, $product_ids, $total_amount){
        //TRANSACTION PERFORMED WHENEVER CHECKOUT BUTTON IS PRESSED 
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
    } */
}
?>
