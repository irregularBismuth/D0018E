<!DOCTYPE html>
<html>

    <head>
       
     <title> 1231313  pepo ProductPage </title>
    </head>

    <body>
        <h1> Product Page (shopping cart) </h1>
        
        <?php
            require_once("db/db.php");
            $connection_obj = $dbc;
            $querySql = "SELECT * FROM animals";
            $fetch_result = $connection_obj->query($querySql);
            echo $fetch_result;
        ?>
    </body>

</html>


