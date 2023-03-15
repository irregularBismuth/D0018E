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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"/>
            
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
        <div id="pageRefresh">
        <?php
            
            require_once("transactionalHandler.php");
            $transactionalHandler->generateBoxFrames();
             
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
          
        ?>
        </div>
        <script>
           $(document).ready(function(){
                $('.badd').submit(function(event){
                    event.preventDefault();
                    var form = $(this);
                    var formData = form.serialize();

                    $.ajax({
                        type: form.attr('method'),
                        url: form.attr('action'),
                        data: formData

                    }).done(function(response){
                        $('#pageRefresh').html(response);

                    }).fail(function(){
                        alert('error');
                    });
                });
            }); 
        </script> 
    </body>

</html>


