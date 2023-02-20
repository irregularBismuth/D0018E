<!DOCTYPE html>
<?php
session_start();
?>

<html>

    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" target="cartMenuSwitch" href="style/popup.css">
    </head>
    
    
    <body>

        <?php                 
            function generateCartButton(){
                echo '
                    <div class="productCart">
                        <a href="productPage.php">
                        <img src="../images/animalIcon.png" alt ="Image" width=70, height=70>
                        </a>
                        <br>
                        <br>
                        Products
                    </div>'; 
            }
        ?>
        

    </body>

</html>
