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
                        <label> Products </label>
                        <img src="../images/animalIcon.png" alt ="Image" width=70, height=70>
                        </a>
                    </div>'; 
            }
        ?>
        

    </body>

</html>
