<?php
session_start();
require_once "sqlHandler.php";
$id=$_GET['succ'];

$milker="select * from animals,ode_item where animal_id=product_id and odeid=:x";
$sqlHandler->half_genericQuery($milker,1,array($id));
$z=$sqlHandler->s->fetchAll();

?>

<html>

<head>

</head>


<body>

<?php

echo "You've recently bought these items would you like to give a review?";

echo "<form>";
foreach($z as $z)
{

    echo $z['animal_name']."";
    
}
echo "</form>";
?>




</body>
</html>
