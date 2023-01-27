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
            
            function generateBoxFrames($countRow, $animalArray){
                //adding some local variable reference:
                $info_name;
                $info_price;
                $info_description;
                for ($i = 0; $i<$countRow;$i++){
                    echo '
                    <div class="row">
                        <div class="columnCart">
                            <div class="boxFrame">
                                <br>
                                <div class="imageEffect">'.$animalArray['image'][$i].'</div>
                                <br> <br>
                                <div class="infoStyle">
                                    Animal type: '.$animalArray['name'][$i].'
                                    <br>
                                    Description: '.$animalArray['category'][$i].'
                                    <br>
                                    Total: '.$animalArray['price'][$i].'
                                </div>            
                                <br> <br>
                                
                                <button class="button"> add </button>  
                                <button class="button"> checkout </button> 
                                <button class="button"> remove </button>
                                <button class="button"> info </button> 
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

            $animal_array = array("name"=>[], "price"=>[], "image"=>[], "category"=>[]);
              
            $connection_obj = $dbc;
            $querySql = "SELECT * FROM animals";
            $queryRowCount = "SELECT COUNT(*) FROM animals";
            $queryItemId = "SELECT * FROM animals WHERE item_id = animal_id";

            $fetch_result = $connection_obj->query($querySql);
            $query_output = $fetch_result->fetchAll();
            $count=$fetch_result->rowCount();

                foreach ($query_output as $query_output) {
                # code...

                    array_push($animal_array['image'], '<img src="'.$query_output['animal_image'].'" alt=image" width="'.$width.'" height"'.$height.'">');

                    array_push($animal_array['name'],$query_output["animal_name"]);         
                    array_push($animal_array['price'],$query_output["animal_price"]);
                    array_push($animal_array['category'],$query_output["animal_category"]);
               
                }
                generateBoxFrames($count, $images_array, $info_array);         
            
        ?>

    </body>

</html>


