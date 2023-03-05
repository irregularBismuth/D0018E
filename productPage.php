<!--<!DOCTYPE html> -->
<?php
session_start();
require_once("userProfile.php");
require_once("sqlHandler.php");
$animals = $sqlHandler->get_product_data();
$row_count = count($animals['image']);
?>
<html>

    <head>
       
     <title> ProductPage </title>
    <link rel="stylesheet" type="text/css" target="cartPage" href="style/shoppingCartStyle.css"/>
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    </head>

    <body>


        <div class="headern">
        <header>

            <a href="site.php">
                <img src="../images/logo.png" width="400">
            </a>
            <?php 
                include("userMenu.php");
            ?>
            <p> <?php include("transactionalMenu.php");?> </p>
            <form role="search" id="form">
                <input type="search" id="query" name="q" placeholder="Search...">
            </form>
        </header>
        </div>
       <br> 
        <?php
                       
            function generateBoxFrames($countRow, $animalArray){
                //adding some local variable reference:
                $additional_data = 0;
                
                for ($i = 0; $i<$countRow;$i++){
                    $product_id = $animalArray['animal_id'][$i];
                    echo '
                        <div class="boxFrame">
                                <div class="section1">
                                        <img class="fit_image" src='.$animalArray['image'][$i].'>
                                </div>
                                <div class="section2">
                                    <div class="infoStyle">
                                        <ul id="infoSection">
                                            <li>Product id: '.$animalArray['animal_id'][$i].' </li>
                                            <br>                             
                                            <li><b>Animal type:</b> '.$animalArray['name'][$i].'</li>
                                            <br>
                                            <li><b>Description:</b> '.$animalArray['category'][$i].'</li>
                                            <br>
                                            <hr>
                                            <li><b>Subtotal:</b> '.$animalArray['price'][$i].'¥ </li>
                                            <br>
                                            <br>
                                            <li>
                                           <form method="POST">
                                                <input type="hidden" name="product_id" value='.$product_id.'> 
                                                <input type="submit" name="addButton" class="button" value="add" />   
                                                <input type="submit" name="infoButton" class="button" value="info" /> 
                                            </form> 
                                            </li>
                                        </ul>
                                    </div>            
                                </div>
                               </div>
                                <br> 
                                <div class="section3">
                                    Section3...
                                </div>
                                
                                <div class="section4">...</div>
                        </div>
                        <br>';
                    
                }
            }
              if (isset($_POST['addButton'])){
                        
                        require_once("transactionalHandler.php");
                        $transactionalHandler->addButtonClickAction();
                                              
                        
                    }  
            generateBoxFrames($row_count, $animals);         
        ?>

    </body>

</html>


