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
    echo "<form action='scHandler.php' method='post'>";
    foreach($res as $res){
        
        echo $res['animal_id'];
    }
    echo "<input type='submit' />";
   echo "</form>"; 
?>
</body>

</html>
