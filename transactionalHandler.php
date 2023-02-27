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
                
                try {
                    $update_id_query = "UPDATE transactional SET customer_id=:x";
                    $param_array = array($this->customer_id);
                    $this->sqlConnector->half_genericQuery($update_id_query, 1, $param_array);
                    $execution = $this->sqlConnector->s->execute();
                }
                catch (PDOException $e){
                    $e->getMessage();
                } 
            }
    }

    function addButtonClickAction(){
        if(isset($_POST['addButton'])){
            $product_id = $_POST['product_id'];
            array_push($this->products_added, $product_id);
            return $this->products_added; 
        }
    }
    
    function execTransaction(){
        /* If the add button form is pressed it should start a new transaction:
 
        - Add if else for checking if(isset($_SESSION['id'] is set = LOGGED IN!
                1. If logged in it should fetch/query transactional.product_id = user.id
                2. If not logged in it should check if(isset($_SESSION['order_id'] instead!
        */

        if(isset($_POST['addButton'])){
            $this->checkCustomerId();
            try {
                $sqlTransaction = $this->sqlConnector->get_db_connector();
                $sqlTransaction->beginTransaction();
                              
                $sql_transactional_query = "SELECT * FROM transactional JOIN animals ON transactional.product_id = animals.animal_id WHERE transactional.order_id =:x";
                $param_array = array($this->customer_id);

                $this->sqlConnector->half_genericQuery($sql_transactional_query, 1, $param_array);
                $execution = $this->sqlConnector->s->execute();
                
            } catch (PDOException $e){
                $this->sqlConnector->get_db_connector()->rollback();
                die($e->getMessage());
            }

        }
        else {
            return $this->products_added = [];
        }
    } 
}
?>
