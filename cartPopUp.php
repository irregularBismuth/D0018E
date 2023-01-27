<!DOCTYPE html>
<?php
session_start();
?>

<html>

    <head>
        <title>...</title>

        <style>button{background-image: "shoppingcart.jpg";}</style>
    </head>
    
    
    <body>

        <?php
            function doSomething(){
                    
                }
            //div productCart should be the layout section
            //button tag should also have a class
            //}
           echo '
                <div id="productCart">
                    <button onclick='.doSomething().'</button>
                </div>
                '  
        
        ?>

    </body>

</html>
