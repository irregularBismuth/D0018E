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
 
    <a href="site.php"><img src="../images/logo.png" width="400"></a>
    <?php generateCartButton(); ?>
    <?php require_once("userMenu.php"); ?>   
    <p> <?php include("transactionalMenu.php");?> </p>
    
<script>
function search() {
    
    var str=document.getElementById("fname").value;
    if (str == "") {
        document.getElementById("livesearch").innerHTML = "";
        document.getElementById("livesearch").style.display="none";
        return;
    }
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("livesearch").innerHTML = xmlhttp.responseText;
            document.getElementById("livesearch").style.display ="block";
        }
    }
    xmlhttp.open("GET", "search.php?q=" + str, true);
    xmlhttp.send();
}

</script>
<form>
    <input type="text" size="30" id="fname" onkeyup="search()">
</form>
  <button>
    <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
  </button>
    <?php
    if(!(isset($_SESSION['username']))){
    echo "<a href='login.php'> Login </a>";
    }
    else {
    echo "<a href='logoutCheck.php'> Logout </a>";
    }
    ?>
        
        </header>
        </div>

    <div id="livesearch" class="livesearch"></div>
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
            if (isset($_POST['addButton']) or isset($_POST['removeButton'])){
                        
                require_once("transactionalHandler.php");
                $transactionalHandler->addButtonClickAction();
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


