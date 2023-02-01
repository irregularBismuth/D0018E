<!DOCTYPE html>
<?php
session_start();
?>

<html>

    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" target="cartPopup" href="popup.css">
    </head>
    
    
    <body>

        <?php                 
            function generateCartButton(){
                echo '
                    <div class="productCart">
                        <a href="productPage.php">
                        <img src="shoppingcart.jpg" alt ="Image" width=70, height=70>
                        </a>
                    </div>'; 
            }
        ?>
        

    </body>

</html>
