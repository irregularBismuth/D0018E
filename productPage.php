<!DOCTYPE html>
<?php
session_start();
require_once("sqlHandler.php");
$animals = $sqlHandler->get_product_data();
$row_count = count($animals['image']);
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
                                    <button class="button"> remove </button>
                                    <button class="button"> info </button> 
                                </div>
                                
                                <div class="section4">...</div>
                        </div>
                        <br>';
                }
            };
               

            $queryRowCount = "SELECT COUNT(*) FROM animals";
            $queryItemId = "SELECT * FROM animals WHERE item_id = animal_id";

            //$count=$fetch_result->rowCount();

            
            generateBoxFrames($row_count, $animals);         
        ?>

    </body>

</html>


