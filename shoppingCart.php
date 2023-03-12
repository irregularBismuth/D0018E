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
    foreach($res as $res){
        echo $res['animal_id'];
    }
   echo $str; 
?>
</body>

</html>
