<!DOCTYPE html>
<?php
session_start();
?>
<html>

    <head>
       
     <title> 123445  pepo ProductPage </title>
    </head>

    <body>
        <h1> Product Page (shopping cart) </h1>

        <div class="row">
            <div class="column">
            </div>

        </div>
        
        
        <?php
            require_once("db/db.php");
            $connection_obj = $dbc;
            $querySql = "SELECT * FROM animals";
            $fetch_result = $connection_obj->query($querySql);
            $query_output = $fetch_result->fetchAll();
            print_r($query_output[0]["animal_name"]."<br>".$query_output[0]["animal_price"]."<br>".$query_output[0]              ["animal_category"]);
            
        ?>
    </body>

</html>


