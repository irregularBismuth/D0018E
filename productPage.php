<!DOCTYPE html>
<?php
session_start();
?>
<html>

    <head>
       
     <title> 12344  pepo ProductPage </title>
    </head>

    <body>
        <h1> Product Page (shopping cart) </h1>
        
        <?php
            require_once("db/db.php");
            $connection_obj = $dbc;
            $querySql = "SELECT * FROM animals";
            $fetch_result = $connection_obj->query($querySql);
            $query_output->fetchAll();
            print_r($query_output);
        ?>
    </body>

</html>


