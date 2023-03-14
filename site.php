<?php
session_start();
//peepo
require_once "sqlHandler.php";

if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit(0);
}

$bad=$_GET['bad'];
$succ=$_GET['succ'];

/*$query="select * from animals where id=1";
$arr=array();
$sqlHandler->half_genericQuery($query,0,$arr);
*/
?>

<html>
<head>
<link rel="stylesheet" type="text/css" class="" href="style/style.css" media="screen" />
</head>
<style>



</style>
<body>
<div class="headern">
<header>
 
    <a href="site.php"><img src="../images/logo.png" width="400"></a>            
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



<!--
<form role="search" id="form">
  <input type="search" id="query" name="q"
   placeholder="Search..."
   aria-label="Search through site content">
-->
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
<div class="main">
           
    <div id="livesearch" class="livesearch"></div>
    
    <div class="products">
      
<?php
    if($succ==1){
        echo "Animals were bought successfully";
    }
    if($bad==1){
        echo "More animals in cart then in stock please remove some to continue";
    }
    if($bad==2){
        echo "No animals in cart add some before checking out";
    }
    if($bad==3){
        echo "Not enough balance to buy these animals download more money before continueing";
    }
    echo "</br>";
    $quer="select * from cart where customer_id=:x";
    $sqlHandler->half_genericQuery($quer,1,array($_SESSION['id'])); 
    $res=$sqlHandler->s->fetchAll();
    $intid=0;
    foreach($res as $res)
    {
        $intid=$res['id'];
    }
    $quer="select * from animals,cart_item where cart_id=:x";
    $sqlHandler->half_genericQuery($quer,1,array($intid)); 
    $res=$sqlHandler->s->fetchAll();
    $tot=0;
    echo "<b>Shoppingcart:</b><br>";
    foreach($res as $res)
    {
        if($res['product_id']==$res['animal_id']){
           $tot+=$res['price']*$res['quantity']; 
            echo "<span>".$res['animal_name']." ".$res['animal_price']." x".$res['quantity']."</span><form action='removeCart.php' method='post' ><input type='hidden' name='cid' value=".$res['id']."><input type='hidden' name='aid' value=".$res['quantity']."><input type='submit' value='Remove'></form></br>";
        }
       /*if($res['product_id']==$res['animal_id']){
            echo "<p>".$res['animal_id']."</p>"
       }*/
    }
    echo "Total: ".$tot."</br><form action='checkOut.php' method='post'><input type='submit' value='Checkout'></form>";
    
    $quer="select * from animals";
    $sqlHandler->half_genericQuery($quer,0,0);  
    $res=$sqlHandler->s->fetchAll();
    foreach($res as $res){
    
        echo "<div class='animal'><img src=".$res['animal_image']."><p>".$res['animal_name']."</p><p>".$res['animal_price']."</p>";
        if($res['animal_quantity'] > 0){
        echo "<form action='scHandler.php' method='post'>";
        echo "<input type='hidden' name='uid' value=".$_SESSION['id']." ><input type='hidden' name='price' value=".$res['animal_price']."><input type='hidden' name='anmid' value=".$res['animal_id']."><input type='submit' value='Add'>"; 
        echo "</form><form action='redirect.php' method='post'><input type='hidden' name='who' value=".$res['animal_id']."><input type='submit' value='info'></form></div>";  
        }
        else{
            echo "Item currently out of stock retry tomorrow";
        }
   
     }
?>
  </div>

</div>
<!--
    <table style="border:1px solid black;margin-left:auto;margin-right:auto;width:50%;">
        <tr>
            <th><a href="../images/cats.php">Cats</a></th>
            <th><a href="../images/large.php">Large animals</a></th>
            <th>Small animals</th>
            <th>About us</th>
        </tr>
    </table>

    <table style="border:1px solid black;margin-left:auto;margin-right:auto;">
        <tr><td><h2>Fetured</h2></td></tr>
        <tr>
            <td><img src="../images/capy.png" width="451" height="342"></td>
            <td>Capybara 6100kr</td>
        </tr>
        <tr>
            <td><img src="../images/large/elefant.jpg"width="451" height="342"></td>
            <td>Elephant 128 699kr</td>
        </tr>
        <tr>
            <td><img src="koala.jpg"width="451" height="342"></td>
            <td>Koala 3.50kr</td>
        </tr>
        <tr>
            <td><img src="cat/tiger.jpg"width="451" height="342"></td>
            <td>Tiger 78 000kr</td>
        </tr>
    </table>
<?php
echo "Hello World!";
?>
-->
</body>
</html> 
