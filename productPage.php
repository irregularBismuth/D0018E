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
    <link rel="stylesheet" type="text/css" href="style/userMenuStyling.css" />
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
                require_once("sqlHandler.php");
                //adding some local variable reference:
                $query = "SELECT * FROM cart WHERE customer_id=:x";
                $sqlHandler->half_genericQuery($query, 1, array($_SESSION['id']));
                $output = $sqlHandler->s->fetchAll();
                $initid = 0;

                foreach($output as $output){
                    $initid=$output['id'];
                }

                $query = "SELECT * FROM animals, cart_item where cart_id=:x";
                $sqlHandler->half_genericQuery($query, 1, array($_SESSION['id']));
                $output = $sqlHandler->s->fetchAll();
                $tot=0;

                foreach($output as $output){
                    if($output['product_id'] == $output['animal_id']){
                        $tot = $output['price']*$output['quantity'];
                    }
                }

                

                for ($i = 0; $i<$countRow;$i++){
                    $product_id = $animalArray['animal_id'][$i];
                    $product_quantity = $animalArray['animal_quantity'][$i];
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
                                                <a href=page.php?a='.$animalArray['animal_id'][$i].'>INFO</a>
                                                </form> 
                                            </li>
                                        </ul>
                                    </div>            
                                </div>
                               </div>
                                <br>    
                        </div>
                        <br>';
                    
                }
            }
            if (isset($_POST['addButton']) or isset($_POST['removeButton'])){
                        
                require_once("transactionalHandler.php");
                $transactionalHandler->addButtonClickAction();
                header("location: ".$_SERVER['REQUEST_URI']);      
                        
            }

            if (isset($_POST['checkoutButton'])){
                require_once("transactionalHandler.php");
                $transactionalHandler->checkoutOrderPlaced();
                header("location: ".$_SERVER['REQUEST_URI']);      
            } 

            if (isset($_POST['submit_balance'])){
                
                require_once("userProfile.php");
                $userProfile->addBalance();  
                header("location: ".$_SERVER['REQUEST_URI']);      
            }
             
            generateBoxFrames($row_count, $animals);         
        ?>

    </body>

</html>


