<?php
session_start();
//peepo
require_once "sqlHandler.php";


$arr=array(1,2);
            $query="select * from animals where animal_name='%$input'";
            $sqlHandler->half_genericQuery($query,0,$arr);
            $res=$sqlHandler->s->fetchAll();
            if($sqlHandler->s->rowCount() > 0)
            {
                foreach ($res as $res) {
                    echo "<div class='productsBox'>".$res['animal_name']."</div></br>";
                }
            }

?>