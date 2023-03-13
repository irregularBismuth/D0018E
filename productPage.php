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
                       
            function generateBoxFrames(){
                include("sqlHandler.php");
                $query = "SELECT * FROM animals";
                $sqlHandler->half_genericQuery($query,0,0);
                $output = $sqlHandler->s->fetchAll();
                foreach($output as $output){
                    $product_id = $output['animal_id'];
                    //$product_quantity = $output['quantity'];
                    echo '
                        <div class="boxFrame">
                                <div class="section1">
                                        <img class="fit_image" src='.$output['animal_image'].'>
                                </div>
                                <div class="section2">
                                    <div class="infoStyle">
                                        <ul id="infoSection">
                                            <li>Product id: '.$output['animal_id'].' </li>
                                            <br>                             
                                            <li><b>Animal type:</b> '.$output['animal_name'].'</li>
                                            <br>
                                            <li><b>Description:</b> '.$output['animal_category'].'</li>
                                            <br>
                                            <hr>
                                            <li><b>Subtotal:</b> '.$output['animal_price'].'¥ </li>
                                            <br>
                                            <br>
                                            <li>
                                           <form method="POST">
                                                <input type="hidden" name="product_id" value='.$product_id.'> 
                                                <input type="hidden" name="price" value='.$output['animal_price'].'>
                                                <input type="submit" name="addButton" class="button" value="add" />   
                                                <a href=page.php?a='.$output['animal_id'].'>INFO</a>
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
                        
                include("transactionalHandler.php");
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
             
            generateBoxFrames();         
        ?>

    </body>

</html>


