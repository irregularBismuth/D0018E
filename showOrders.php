<?php
session_start();
//peepo
require_once "sqlHandler.php";
require_once("cartMenuSwitch.php");


if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit(0);
}

$id=$_SESSION['id'];

if($_SESSION['admin']==0){
$milkerz="select * from ode where customer_id=:x";
$sqlHandler->half_genericQuery($milkerz,1,array($id));
}
else
{
$milkerz="select * from ode";
$sqlHandler->half_genericQuery($milkerz,0,0); 
}
$rez=$sqlHandler->s->fetchAll();
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css" />
</head>

<body>
<div class="headern">
<header>
 
    <a href="shoppingCart.php"><img src="../images/logo.png" width="400"></a>
    <?php if($_SESSION['admin']==1){ echo "<a href='addnew.php'> Add new animal </a>"; }?>
    <?php echo "<a href='showOrders.php'>Order history</a>"; ?> 
     <?php generateCartButton(); ?>
    <?php require_once("userMenu.php"); ?>    
<script>
function search() {
    
    var str=document.getElementById("fname").value;
    if (str == "") {
        document.getElementById("livesearch").innerHTML = "";
        document.getElementById("livesearch").style.display="none";
        return;
    }
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("livesearch").innerHTML = xmlhttp.responseText;
            document.getElementById("livesearch").style.display ="block";
        }
    }
    xmlhttp.open("GET", "search.php?q=" + str, true);
    xmlhttp.send();
}

</script>
<form>
    <input type="text" size="30" id="fname" onkeyup="search()">
</form>
  <button>
    <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
  </button>
    <?php
    if(!(isset($_SESSION['username']))){
    echo "<a href='login.php'> Login </a>";
    }
    else {
    echo "<a href='logoutCheck.php'> Logout </a>";
    }
    ?>
</header>
</div>

    <div id="livesearch" class="livesearch"></div>
<?php

echo "<h1>Order history: </h1>";
foreach($rez as $rez){
    if($_SESSION['admin']==1){
     $milk="select * from users where id=:x";
     $sqlHandler->half_genericQuery($milk,1,array($rez['customer_id']));
     $z=$sqlHandler->s->fetchAll();
    foreach($z as $z) { echo "User: ".$z['name']."  "; }
    }
    $odeid=$rez['id'];
    $milkert="select * from animals,ode_item where animal_id=product_id and odeid=:x";
    $sqlHandler->half_genericQuery($milkert,1,array($odeid));
    $p=$sqlHandler->s->fetchAll();    
    echo "order number: ".$rez['id']." Ordertime".$rez['dateTime'];
    foreach($p as $p)
    {
        echo "  ".$p['animal_name']." x ".$p['quantity']." price: ".$p['price']." ";    
    }
    echo " Total cost of ".$rez['total']."</br>";
    
}

?>

</body>

</html>
