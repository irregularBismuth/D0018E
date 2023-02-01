<!DOCTYPE html>
<?php
session_start();
?>

<html>

    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" target="cartMenuSwitch" href="popup.css">
    </head>
    
    
    <body>

        <?php                 
            function generateCartButton(){
                echo '
                    <div class="productCart">
                        <a href="productPage.php">
                        <img src="cartIcon.png" alt ="Image" width=50, height=50>
                        </a>
                    </div>'; 
            }
        ?>
        

    </body>

</html>
