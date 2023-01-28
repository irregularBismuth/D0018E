<?php
session_start();
?>
<html>

<head>
    <title>...</title>

</head>

<body>
    <h1>hi</h1>

    <?php
    require_once("db/db.php");

    class SQLHandler {
        public $db_connector;
        public $query_array;

        function __construct($db_connector)
        {
            $this->db_connector = $db_connector;
            $this->query_array = []; //initilize an empty array that should store unique users queries.
        }
    
        function get_product_data(){
            /*
            This metod should request query from our database that show product/item data on our site
            */
            
            $query = "SELECT * FROM animals";
            $queryUser = "SELECT * FROM animals WHERE item_id = animal_id";
        
            $fetch_result = $this->db_connector->query($query);
            //$row_count = $fetch_result->rowCount();
            $output = $fetch_result->fetchAll();

            foreach($output as $output){
                echo $output['animal_name'];
            }

        }
    }
    $obj = new SQLHandler($dbc);
    echo $obj->get_product_data();
    
    ?>
    
</body>

</html>

