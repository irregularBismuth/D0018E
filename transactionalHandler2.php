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

     function addToCart() {
    $customer_id=$_SESSION['id'];
    $price_per_item=$_POST['price'];
    $quantity=1;
    $product_id=$_POST['product_id'];
    // Check if the customer already has a cart
    $cart_query = "SELECT * FROM cart WHERE customer_id = :x";
    $cart_data = $sqlHandler->half_genericQuery($cart_query, 1, array($customer_id));

    if (empty($cart_data)) {
        // If the customer does not have a cart, create one
        $cart_insert_query = "INSERT INTO cart (customer_id) VALUES (:x)";
        $sqlHandler->half_genericQuery($cart_insert_query, 1, array($customer_id));
        $cart_id = $sqlHandler->getLastInsertedID();
    } else {
        $cart_id = $cart_data[0]['id'];
    }

    // Check if the product already exists in the cart
    $cart_item_query = "SELECT * FROM cart_item WHERE cart_id = :x AND product_id = :y";
    $cart_item_data = $sqlHandler->half_genericQuery($cart_item_query, 2, array($cart_id, $product_id));

    if (empty($cart_item_data)) {
        // If the product does not exist in the cart, add it
        $cart_item_insert_query = "INSERT INTO cart_item (cart_id, product_id, quantity, price) VALUES (:x, :y, :z, :w)";
        $sqlHandler->half_genericQuery($cart_item_insert_query, 4, array($cart_id, $product_id, $quantity, $price_per_item));
    } else {
        // If the product already exists in the cart, update its quantity
        $new_quantity = $cart_item_data[0]['quantity'] + $quantity;
        $cart_item_update_query = "UPDATE cart_item SET quantity = :x WHERE cart_id = :y AND product_id = :z";
        $sqlHandler->half_genericQuery($cart_item_update_query, 3, array($new_quantity, $cart_id, $product_id));
    }
} 
       /* $quer="select * from cart where customer_id = :x";
        $arr=(array($_SESSION['id']));
        $this->sqlConnector->half_genericQuery($quer,1,$arr);
        $res=$this->sqlConnector->s->fetchAll();
      //  foreach($res as $res) { }
        if($res===false)
        {
            $query="insert into carts(customer_id) values(:x)";
            $arr2=(array($_SESSION['id']));
            $this->sqlConnector->s->half_genericQuery($query,1,$arr2);
            $res=$this->sqlConnector->s->lastInsertId();
        
        }
        else {
            $res=res['cart_id'];
        }

        $quee="insert into cart_item(cart_id,product_id,quantity,price) values(:x,:y,:z,:w)";
        $arre=array($res,$_POST['product_id'],1,$_POST['price']);
        $rez=$this->sqlConnector->s->half_genericQuery($quee,4,$arre);
        */ 
 
    
    
    function checkout()
    {

    }
}
?>
