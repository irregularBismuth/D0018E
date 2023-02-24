<?php
session_start();
require_once("sqlHandler.php");
require_once("userProfile.php");
$transactionalHandler = new TransactionalHandler($sqlHandler);

?>

<?php 
class TransactionalHandler{
    private $products_added;
    private $sqlConnector;
    private $session_order_id;

    function __construct($sqlConnectorReference)
    {
        session_start();
        $this->products_added = [];
        $this->sqlConnector = $sqlConnectorReference;
        $this->session_order_id = "";
        
    }
    
    function execTransaction(){
        /* If the add button form is pressed it should start a new transaction:
 
        - Add if else for checking if(isset($_SESSION['id'] is set = LOGGED IN!
                1. If logged in it should fetch/query transactional.product_id = user.id
                2. If not logged in it should check if(isset($_SESSION['order_id'] instead!
        */

        if(isset($_POST['addButton'])){
            //assing order id here: $this->order_id =
            $this->session_order_id = session_create_id();
            session_id($this->session_order_id);
            session_start();
            $_SESSION['order_id'] = $this->session_order_id;
            session_commit();
            echo $this->session_order_id;
            
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
