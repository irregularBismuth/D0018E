<!DOCTYPE html>
<?php
session_start();
?>

<html>

    <head>
        <title>....</title>
        <link rel="stylesheet" type="text/css" target="cartPopup" href="popup.css">
    </head>
    
    
    <body>

        <?php
            function changeToProductPage(){
                    echo '<a href=productPage.php>';
                }
            function generateCartButton(){
                echo '
                    <div class="productCart">
                        <button class="button" onclick='.changeToProductPage().'>
                        <img src="shoppingcart.jpg" alt ="Image" width=80, height=80>
                        </button>
                    </div>'; 
            }
        ?>
        

    </body>

</html>
