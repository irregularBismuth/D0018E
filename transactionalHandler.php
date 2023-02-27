<?php
session_start();
require_once("sqlHandler.php");
require_once("userProfile.php");
$sql = $sqlHandler;
$transactionalHandler = new TransactionalHandler($sql);
?>

<?php 
class TransactionalHandler{
    private $products_added;
    private $sqlConnector;
    private $session_order_id;
    private $customer_id;
    private $product_id; 

    function __construct($sqlConnectorReference)
    {
        session_start();
        $this->products_added = [];
        $this->sqlConnector = $sqlConnectorReference;
        $this->session_order_id = "";
        $this->customer_id = "";
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
            if(isset($_SESSION['product_cart'])){
    
                $product_id = $_POST['product_id'];
                $count = count($_SESSION['product_cart']);
                $_SESSION['product_cart'][$count] = $this->products_added;
                //array_push($this->products_added, $product_id);
            }
            else{
                $product_id = $_POST['product_id'];
                $this->products_added = array('animal_id' => $product_id);
                $_SESSION['product_cart'][0] = $this->products_added;
            } 
        }
    }
    
    function execTransaction(){
        /* If the add button form is pressed it should start a new transaction:
 
        - Add if else for checking if(isset($_SESSION['id'] is set = LOGGED IN!
                1. If logged in it should fetch/query transactional.product_id = user.id
                2. If not logged in it should check if(isset($_SESSION['order_id'] instead!
        */
    
            try {
                $sqlTransaction = $this->sqlConnector->get_db_connector();
                $sqlTransaction->beginTransaction();
                              
                $sql_transactional_query = "SELECT * FROM transactional JOIN animals ON transactional.product_id = animals.animal_id WHERE transactional.order_id =:x";
                $sql_query = "SELECT * FROM animals WHERE animal.animal_id =:x";
                $param_array = array($this->customer_id);

                $this->sqlConnector->half_genericQuery($sql_transactional_query, 1, $param_array);
                $execution = $this->sqlConnector->s->execute();
                
            } catch (PDOException $e){
                $this->sqlConnector->get_db_connector()->rollback();
                die($e->getMessage());
            }
    } 
}
?>
