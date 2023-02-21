<?php
session_start();
//peepo
require_once "sqlHandler.php";
//echo "oskar";

    $input=$_REQUEST['q']."%";
    $arr=array($input);
    $query="select * from animals where animal_name like :x";
    $sqlHandler->half_genericQuery($query,1,$arr);
    $res=$sqlHandler->s->fetchAll();
    if($sqlHandler->s->rowCount() > 0)
    {
        foreach ($res as $res) {
             echo "<div class='searchBox'><ul><li><div class='searchImage'><img src=".$res['animal_image']."></div></li><li>".$res['animal_name']."</li><li>".$res['animal_price']." ¥</li></ul></div></br>";
        }
    }
?>
