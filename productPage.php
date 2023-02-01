<!DOCTYPE html>
<?php
session_start();
require_once("sqlHandler.php");
$animals = $sqlHandler->get_product_data();
$row_count = count($animals['image']);
?>
<html>

    <head>
       
     <title> ProductPage </title>
    <link rel="stylesheet" type="text/css" target="cartPage" href="shoppingCartStyle.css"/>
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    </head>

    <body>


        <div class="headern">
        <header>

            <a href="site.php">
                <img src="logo.png" width="400">
            </a>
            <h3>Product cart</h3>
            <form role="search" id="form">
                <input type="search" id="query" name="q" placeholder="Search...">
            </form>
        </header>
        <br>
        </div>
        
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
               
            generateBoxFrames($row_count, $animals);         
        ?>

    </body>

</html>


