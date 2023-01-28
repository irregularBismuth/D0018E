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
    $obj = new SQLHandler($dbc);
    echo $obj->get_query();

    class SQLHandler {
        public $db_connector;
        public $query;

        function __construct($db_connector)
        {
            $this->db_connector = $db_connector;
        }
    
        function get_query(){
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
    echo $obj->get_query();
    
    ?>
    
</body>

</html>

