<!DOCTYPE html>
<?php
session_start();
?>
<html>

    <head>
       
     <title> 1234455555555  pepo ProductPage </title>
    <link rel="stylesheet" type="text/css" target="cartPage" href="shoppingCartStyle.css">
    </head>

    <body>

        <h1> Product Page (shopping cart) </h1>
        
        <?php
            
            function generateBoxFrames($countRow, $image, $info){
                for ($i = 0; $i<$countRow;$i++){
                    echo '
                    <div class="row">
                        <div class="columnCart">
                            <div class="boxFrame">
                                '$image[i]' <br>
                                <button> add </button> <br> 
                                <button> checkout </button> <br> 
                                <button> remove </button> <br>
                                <button> info </button> 
                            </div> 
                        </div>
                    </div>
                    <br>';
                }
            };
               

            // Will add better logic to this:
            require_once("db/db.php");
            $width="100";
            $height="100";

            $images_array = [];
            $images_array = array();
            $images_array = (array) null;
            
            $info_array = [];
            $info_array = array();
            $info_array = (array) null;

            $connection_obj = $dbc;
            $querySql = "SELECT * FROM animals";
            $queryRowCount = "SELECT COUNT(*) FROM animals";
            $queryItemId = "SELECT * FROM animals WHERE item_id = animal_id";

            $fetch_result = $connection_obj->query($querySql);
            $query_output = $fetch_result->fetchAll();
            $count=$fetch_result->rowCount();

                foreach ($query_output as $query_output) {
                # code...
                echo "Animal type: ".$query_output["animal_name"]."<br>".'<img src="'.$query_output['animal_image'].'" alt="image" width="'.$width.'" height="'.$height.'">'."<br>"."Price: ".$query_output["animal_price"]."<br>"."Description: ".$query_output["animal_category"]."<br>";


                array_push($images_array,'<img src="'.$query_output['animal_image'].'" alt=image" width="'.$width.'" height"'.$height.'">');

                array_push($info_array,'Animal type: '.$query_output["animal_name"]."<br>"."Price: ".$query_output["animal_price"]."<br"."Description: ".$query_output["animal_category"]);
                generateBoxFrames($count, $images_array, $info_array);


            }
            echo $images_array[1];
            
        ?>

    </body>

</html>


