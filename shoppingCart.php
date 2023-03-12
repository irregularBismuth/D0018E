<?php
session_start();
require_once "sqlHandler.php";


?>

<html>
 <head>
 </head>
    
<body>
<?php
    $quer="select * from animals";
    $sqlHandler->half_genericQuery($quer,0,0);  
    $res=$sqlHandler->s->fetchAll();
    foreach($res as $res){
        
        echo "<form action='scHandler.php' method='post'>";
        echo "<input type='hidden' name='anmid' value=".$res['animal_id']."/><input type='submit' value='Add Item'/>";    
        echo "</form>"; 
   
     }
?>
</body>

</html>
