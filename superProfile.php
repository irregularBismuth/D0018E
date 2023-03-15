<?php
session_start();
require_once "sqlHandler.php";
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
    <?php echo "<a href='shoppingCart.php'>shopping cart</a>"; ?> 
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
if($_GET['succ']==1){
    echo "successfully downloaded some hard earned cashirones</br>";
}

if($_GET['succ']==3){ echo "changed username";} 
if($_GET['bad']==1){
    echo "Can't change username username already exist";
}
if($_SESSION['admin']==1){
$dll="select * from users";
$sqlHandler->half_genericQuery($dll,0,0);
$w=$sqlHandler->s->fetchAll();
    foreach($w as $w){
     echo "<h2>USER: ".$w['name']."</h2>";
     echo "</br> balance: ".$w['balance']."</br>";
     echo "Alter username <form action='alterUser.php' method='post'><input type='text' name='nm' ><input type='hidden' name='hid' value=".$w['id']."><input type='submit' value='update username'></form></br>";
     echo "Alter user balance  <form method='post' action='alterCurrency.php'><input type='number' name='num' min='0' max='999999'><input type='hidden' name='hid' value=".$w['id']."><input type='submit' value='update money'></form></br>";
   // echo "<form type='deleteUser.php' method='post'><input type='hidden' name='hid' value=".$w['id']."><input type='submit' value='deleteAccount'></form></br>";
    }
}
else {
    $dll="select * from users where id=:x";
    $sqlHandler->half_genericQuery($dll,1,array($_SESSION['id']));
    $w=$sqlHandler->s->fetchAll();
    foreach($w as $w){
     echo "user balance ".$w['balance']." for user: ".$w['name'];
     echo "Download more money here <form method='post' action='alterCurrency.php'><input type='number' name='num' min='0' max='999999'><input type='hidden' name='hid' value=".$w['id']."><input type='submit' value='update money'></form>";
    }
}




?>
</body>
</html>
