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

    class SQLHandler {
        public $sql;
        public $query;

        function __construct()
        {
            $this->sql = require($dbc); 

        }
    
        public function get_query(){
            $query = "SELECT * FROM animals";
        
            $fetch_result = $this->sql->query($query);
            //$row_count = $fetch_result->rowCount();
            $output = $fetch_result->fetchAll();

            foreach($output as $output){
                echo $output['animal_name'];
            }

        }
    }
    
    $obj = new SQLHandler();
    echo "adadaudduahuahaduhd"; 
    ?>
    
</body>

</html>

