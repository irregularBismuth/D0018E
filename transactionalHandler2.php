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

    function addToCart()
    {   
        $quer="select * from carts where customer_id = :x";
        $arr=(array($_SESSION['id']));
        $this->sqlConnector->half_genericQuery($quer,1,$arr);
        $res=$this->sqlConnector->s->fetchAll();
        foreach($res as $res) { }
        if($res===false)
        {
            $query="insert into carts(customer_id) values(:x)";
            $arr2=(array($_SESSION['id']));
            $this->sqlConnector->s->half_genericQuery($query,1,$arr2);
            $cid=$this->sqlConnector->s->lastInsertId();
        
        }
        else {
            $cid=res['cart_id'];
        }

    }
    
    function checkout()
    {

    }
}
?>
