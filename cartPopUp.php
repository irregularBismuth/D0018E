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
                        <img src="cartIcon.png" alt ="Image" width=60, height=60>
                        </a>
                    </div>'; 
            }
        ?>
        

    </body>

</html>
