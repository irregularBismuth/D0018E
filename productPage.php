<!DOCTYPE html>
<html>

    <head>
       
     <title> 1231313  pepo ProductPage </title>
    </head>

    <body>
        <h1> Product Page (shopping cart) </h1>
        
        <?php
            require_once("db/db.php")
            $query_sql = "SELECT ´animal_name´ FROM animals";
            $fetch_result = $dbc->query($query_sql)
        ?>
    </body>

</html>


