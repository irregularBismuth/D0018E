<?php
session_start();
//peepo
require_once "sqlHandler.php";
require_once("cartMenuSwitch.php");


if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit(0);
}
$who=$_REQUEST['a'];
$query="select * from animals where animal_id=:x";
$arr=array($who);
$sqlHandler->half_genericQuery($query,1,$arr); 
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
    <?php if($_SESSION['admin']==1){ echo "<a href='addnew.php'> Add new animal </a>"; }?>
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
      
      if($_SESSION['admin']==1)
      {
         echo "<form action='delete.php' method='post'><input type='hidden' name='animal_id' value=".$who."><input value='Delete post' type='submit'></form>";   
      } 

    ?>
    <div class="producten">
<?php
 
            /*   $product_id = $_GET['id'];

               $res = $sqlHandler->FETCH("SELECT * FROM products WHERE id = ?", [$product_id]);
       
               $avg_rating_row = $sqlHandler->FETCH("SELECT AVG(rating) AS avg_rating FROM reviews WHERE product_id = ?", [$product_id]);
               $avg_rating = round($avg_rating_row['avg_rating'], 1);
*/

    
              echo "<h1><span>".$res['animal_name']."</span></h1>";  
              echo "<div class='pageImage'><img src=".$res['animal_image']." /></div>";
              echo "<div class='buyInfo'><p>Description: <span>".$res['animal_category']."</span></p> Price: ".$res['animal_price'];
                if($res['animal_quantity'] > 0){  
            echo "<form action='scHandler.php' method='post'>"; 
              echo "<input type='hidden' name='uid' value=".$_SESSION['id']." ><input type='hidden' name='price' value=".$res['animal_price'].">";
              echo "<input type='hidden' name='anmid' value=".$res['animal_id']."><input type='submit' value='Add to cart'></form></div>"; 
            }
            else{
                echo "This animal is currently out of stock";
            }
            

            //<input type='hidden' name='price' value=".$res['animal_price']."><input value='Add to cart' type='submit'  /></form></div>";
                
            
                //if($res['animal_quantity'] > 0){
               // echo "<form action='scHandler.php' method='post'>";
               // echo 
             /*  "<input type='hidden' name='uid' value=".$_SESSION['id']." >
                <input type='hidden' name='price' value=".$res['animal_price'].">
                <input type='hidden' name='anmid' value=".$res['animal_id'].">
                <input type='submit' value='Add'>"; 
        */

        
             $frog="select MAX(id) as gii,AVG(rate) as frogz from rating";
             $sqlHandler->half_genericQuery($frog,0,array(0));
             $f=$sqlHandler->s->fetchAll();
             foreach($f as $f) { echo "This animal has an average score of ".$f['frogz']." With a total of number of ratings ".$f['gii'];}
         ?>

        <div class="rating">
            <form action = "rating.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $who; ?>" />
                <label for="rating">Rate this product:</label>
                <select id="rating" name="ratingx">
                    <option value="1">1 banana</option>
                    <option value="2">2 bananas</option>
                    <option value="3">3 bananas</option>
                    <option value="4">4 bananas</option>
                    <option value="5">5 bananas</option>
                </select>
                <input type="submit" name="submit_rating" value='Leave rating'>
            </form>
        </div>

        <div class="comments">
            <form method="post" action="comments.php"> 
                <textarea class="comment" name="comment" id="comment" placeholder="Comment here"></textarea>  
                <input type="hidden" name="name" value="<?php echo $_SESSION['username']; ?>" />
                <input type="hidden" name="animal_id" value="<?php echo $who; ?>" />
                <input type="submit" name="subknapp" value="Comment"/>
             </form>

            <?php 
               $quer="select * from comments where animal_id=:x order by comment_id, parent_comment_id asc";  
               $sqlHandler->half_genericQuery($quer,1,$arr);
               $rez=$sqlHandler->s->fetchAll();
               if($sqlHandler->s->rowCount() > 0)
               {
                    foreach($rez as $rez){
                        $sr="";
                        if($_SESSION['admin']==1){
                        $sr="<form action='delcom.php' mehod='get'><input type='hidden' name='aid' value=".$who."><input type='hidden' name='comid' value=".$rez['comment_id']."><input type='submit'></form>"; } 
                        echo "<div class='com'><span style='font-weight:bold'>".$rez['comment_username']."</span></p><p>".$rez['comment_time']."</p><p>".$rez['comment']."</p>".$sr."</div>";
                    }     
               }
            ?>
            
             
        </div>
       
    <div>


</body>
</html> 
