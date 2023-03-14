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
        <script>
            function search() { 
                var str=document.getElementById("badd").value;
                if (str == "") {
                    document.getElementById("cartIcon").innerHTML = "";
                    document.getElementById("cartIcon").style.display="none";
                return;
                }
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("cartIcon").innerHTML = xmlhttp.responseText;
                        document.getElementById("cartIcon").style.display ="block";
                    }
                }
                xmlhttp.open("GET", "search.php?q=" + str, true);
                xmlhttp.send();
                }
        </script>
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

    </body>

</html>


