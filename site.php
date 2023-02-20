<!DOCTYPE html>
<?php
session_start();
//peepo
require_once "sqlHandler.php";
require_once("cartMenuSwitch.php");
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
    <?php echo "Welcome: ".$_SESSION['username']; ?>

    
<script>
    function Search(str){
        if(str.lenght==0){
            document.getElementById("livesearch").innerhtml="";
            document.getElementById("livesearch").style.border="0px";
            return
        }
        var xmlhttp = XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                document.getElementById("livesearch").innerHTML=this.responseText;
                document.getElementById("livesearch").style.border="1px solid #A5ACB2"
            }
        }
        xmlhttp.open("GET","search.php?q="+str,true);
        xmlhttp.send();
    }
</script>
<form>
    <input type="text" size="30" onkeyup="Search(this.value)">
    <div id="livesearch"></div>
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
</form>
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
        
    <div class="bar">
        <ul>
            <li>Cats</li>
            <li>African</li>
            <li>Wolves</li>
        </ul>
    </div>
    
    <div class="products">
<?php
            $arr=array(1,2);
            $query="select * from animals";
            $sqlHandler->half_genericQuery($query,0,$arr);
            $res=$sqlHandler->s->fetchAll();
            if($sqlHandler->s->rowCount() > 0)
            {
                foreach ($res as $res) {
                    echo "<div class='productsBox'>".$res['animal_name']."</div></br>";
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
