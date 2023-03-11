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
    $sqlHandler->half_genereicQuery($quer,0,0);  
    $res=$sqlHandler->s->fetchAll();

    $str="<form action='scHandler.php' method='post'>";
    foreach($res as $res){
        $str=$str."<input type='number' name='anmquanity' /><input type='hidden' value=".$res['animal_id']."><input type='button' value='addToCart' name='animalButton' /></br>"; 
    }
    $str=$str."</form>";
   echo $str; 
?>
</body>

</html>
