<?php
session_start();
require_once "sqlHandler.php";


?>

<html>
 <head>
 </head>
    
<body>
<?php
     
    echo "<form action='shoppingCartHandler.php' method='post'><input type='number' name='anmquanity' /><input type='button' value='addToCart' name='animalButton' /><input type='submit' /></form>"; 
    ?>
</body>

</html>
