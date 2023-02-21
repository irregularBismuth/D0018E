<?php
session_start();
require_once("sqlHandler.php");
require_once("userProfile.php");


?>

<?php 
class TransactionalHandler{
    private $products_added;
    private $sqlConnector;
    private $order_id;

    function __construct($sqlConnectorReference)
    {
        session_start();
        $this->products_added = [];
        $this->sqlConnector = $sqlConnectorReference;
        $this->order_id = null;
        
    }
    
    function execTransaction(){
        /* If the add button form is pressed it should start a new transaction */
        if(isset($_POST['addButton'])){
            //assing order id here: $this->order_id = 

            $sqlTransaction = $this->sqlConnector->get_db_connector();
            $sqlTransaction->beginTransaction();

        
            $sql_transactional_query = "SELECT * FROM transactional JOIN animals ON transactional.product_id = animals.animal_id WHERE transactional.order_id =:x";
            $param_array = array($this->order_id);

            $this->sqlConnector->half_genericQuery();
        }
        else {
            return $this->products_added = [];
        }
    } 
}
?>
