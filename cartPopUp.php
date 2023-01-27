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
            function doSomething(){
                    echo '<form method="POST action="cartPopup.php">
                    <input type="submit"/> </form>';
                }
            //div productCart should be the layout section
            //button tag should also have a class
            //}
           echo '
                <div class="productCart">
                    <button class="button" onclick='.doSomething().'>
                        <img src="shoppingcart.jpg" alt ="Image" width=80, height=80>
                    </button>
                </div>
                '  
        
        ?>

    </body>

</html>
