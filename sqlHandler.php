<!DOCTYPE html>

<?php
session_start();
?>

<?php

class SQLHandler {
    public $test = require_once("db/db.php").$dbc;
    public $sql;
    public $query;

    function __construct()
    {
        $this->sql = $this->test; 

    }
    
    public function get_query(){
        $query = "SELECT * FROM animals";
        
        $fetch_result = $this->sql->query($query);
        $row_count = $fetch_result->rowCount();
        $output = $fetch_result->fetchAll();

        foreach($output as $output){
            echo $output['animal_name'];
        }

    }
}
?>

<html>

<head>
    <title>...</title>

</head>

<body>
</body>


    <?php
    $obj = new SQLHandler();
    echo 'hej'; 
    ?>

</body>

</html>

