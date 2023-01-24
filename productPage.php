<!DOCTYPE html>
<?php
session_start();
?>
<html>

    <head>
       
     <title> 1234455  pepo ProductPage </title>
    <link rel="stylesheet" type="text/css" target="cartPage" href="shoppingCartStyle.css">
    </head>

    <body>

        <h1> Product Page (shopping cart) </h1>
        
        <?php

            echo '
                <div class="row">

                    <div class="columnCart">
                       <div class="boxFrame">
                            <div class: "columnImage">
                                IMAGE HERE
                            </div>
                            <div class: "columnData">
                                DATA HERE
                            </div>
    
                            <button> add </button> <br> 
                            <button> checkout </button> <br> 
                            <button> remove </button> <br>
                            <button> info </button> 
                        </div>  
                    </div>

                    <div class="columnCart">
                       <div class="boxFrame">
                            <button> add </button> <br> 
                            <button> checkout </button> <br> 
                            <button> remove </button> <br>
                            <button> info </button> 
                        </div> 
                    </div>

                    <div class="columnCart">
                        <div class="boxFrame">
                            <button> add </button> <br> 
                            <button> checkout </button> <br> 
                            <button> remove </button> <br>
                            <button> info </button> 
                        </div>
                    </div> 

                    <div class="columnCart">
                       <div class="boxFrame">
                            <button> add </button> <br> 
                            <button> checkout </button> <br> 
                            <button> remove </button> <br>
                            <button> info </button> 
                        </div> 
                    </div>
        
                </div>';

            echo "<br>";  

            // Will add better logic to this:
            require_once("db/db.php");
            $width="100";
            $height="100";
            $connection_obj = $dbc;
            $querySql = "SELECT * FROM animals";
            $queryRowCount = "SELECT COUNT(*) FROM animals";
            $fetch_result = $connection_obj->query($querySql);
            $query_output = $fetch_result->fetchAll();

                foreach ($query_output as $query_output) {
                # code...
               echo "Animal type: ".$query_output["animal_name"]."<br>".'<img src="'.$query_output['animal_image'].'" alt="image" width="'.$width.'" height="'.$height.'">'."<br>"."Price: ".$query_output["animal_price"]."<br>"."Description: ".$query_output["animal_category"]."<br>";

               $images = $query_output["animal_image"];

            } 
        ?>

    </body>

</html>


