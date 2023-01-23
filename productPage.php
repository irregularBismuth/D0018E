<!DOCTYPE html>
<?php
session_start();
?>
<html>

    <head>
       
     <title> 1234455  pepo ProductPage </title>
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
                foreach ($query_output as $query_output) {
                # code...
               echo $query_output["animal_name"]."<img src=".$query_output['animal_image'].">"."<br>".$query_output["animal_price"]."<br>".$query_output["animal_category"];
               $images = $query_output["animal_image"];

            } 
        ?>

    </body>

</html>


