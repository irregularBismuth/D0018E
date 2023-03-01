<?php
session_start();
//peepo
require_once "sqlHandler.php";
require_once("cartMenuSwitch.php");

$query="select * from animals where animal_id=2";
$arr="test";
$sqlHandler->half_genericQuery($query,0,$arr); 
$res=$sqlHandler->s->fetchAll();
if($sqlHandler->s->rowCount() > 0)
{
     foreach ($res as $res) {
    
     }
}

?>

<html>
<head>
<link rel="stylesheet" type="text/css" class="" href="style/style.css" media="screen" />
</head>

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

    <div class="bar">
        <ul>
            <li>Cats</li>
            <li>African</li>
            <li>Wolves</li>
        </ul>
    </div>


    <div class="producten">
    
<?php 

if($sqlHandler->s->rowCount() > 0)
{
     foreach ($res as $res) {
         echo "<div class='searchImg'><img src=".$res['animal_img']."/></div>";
     }
}

?>


        <div class="comments">
            <p>Peepo peepo peepo frog</p> 
        </div>            
    <div>


</body>
</html> 
