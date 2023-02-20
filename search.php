<?php
session_start();
//peepo
require_once "sqlHandler.php";

$input=$_GET['q'];
            $arr=array($input);
            $query="select * from animals where animal_name like %:x";
            $sqlHandler->half_genericQuery($query,1,$arr);
            $res=$sqlHandler->s->fetchAll();
            if($sqlHandler->s->rowCount() > 0)
            {
                foreach ($res as $res) {
                    echo "<div class='productsBox'>".$res['animal_name']."</div></br>";
                }
            }

?>
