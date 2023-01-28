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
            
            if(!isset($_SESSION["cart"])){
                $_SESSION["cart"] = array();
            }
            
            function generateBoxFrames($countRow, $animalArray){
                //adding some local variable reference:
                $additional_data = 0;
                
                for ($i = 0; $i<$countRow;$i++){
                    echo '
                        <div class="boxFrame">
                                <div class="section1">
                                        <img class="fit_image" src='.$animalArray['image'][$i].'>
                                </div>

                                <div class="section2">
                                    <div class="infoStyle">
                                        <ul id="infoSection">                             
                                            <li><b>Animal type:</b> '.$animalArray['name'][$i].'</li>
                                            <br>
                                            <li><b>Description:</b> '.$animalArray['category'][$i].'</li>
                                            <br>
                                            <hr>
                                            <li><b>Subtotal:</b> '.$animalArray['price'][$i].'</li>
                                        </ul>
                                    </div>            
                                </div>
                               </div>
                                <br> 
                                <div class="section3">
                                    <button class="button"> add </button>  
                                    <button class="button"> checkout </button> 
                                    <button class="button"> </button>
                                    <button class="button"> info </button> 
                                </div>
                                
                                <div class="section4">...</div>
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

                    //array_push($animal_array['image'], '<img src="'.$query_output['animal_image'].'" alt=image" width="'.$width.'" height"'.$height.'">');


                    array_push($animal_array['image'],$query_output['animal_image']);

                    array_push($animal_array['name'],$query_output["animal_name"]);         
                    array_push($animal_array['price'],$query_output["animal_price"]);
                    array_push($animal_array['category'],$query_output["animal_category"]);
               
                }
                generateBoxFrames($count, $animal_array);         
            
        ?>

    </body>

</html>


