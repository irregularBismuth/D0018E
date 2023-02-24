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

    function __construct($sqlConnectorReference)
    {
        session_start();
        $this->products_added = [];
        $this->sqlConnector = $sqlConnectorReference;
        $this->session_order_id = "";
        $this->customer_id = "";
        
    }

    function checkCustomerId(){
        require_once("userProfile.php");
        
        if($userProfile->checkIfUserIdSet()){ 
            $_SESSION['customer_id'] = $_SESSION['id'];
            $this->customer_id = $_SESSION['id'];
            $update_id_query = "UPDATE transactional SET customer_id=:x where users.id=:y";
            $param_array = array($this->customer_id);
            $this->sqlConnector->half_genericQuery($update_id_query, 1, $param_array);
            $output = $this->sqlConnector->s->
        }
        else {          
                $this->customer_id = session_create_id();
                session_id($this->customer_id);
                session_start();
                $_SESSION['customer_id'] = $this->session_order_id;
                session_commit();
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
            
            $sqlTransaction = $this->sqlConnector->get_db_connector();
            $sqlTransaction->beginTransaction();
                              
            $sql_transactional_query = "SELECT * FROM transactional JOIN animals ON transactional.product_id = animals.animal_id WHERE transactional.order_id =:x";
            $param_array = array($this->session_order_id);

            $this->sqlConnector->half_genericQuery();
        }
        else {
            return $this->products_added = [];
        }
    } 
}
?>
