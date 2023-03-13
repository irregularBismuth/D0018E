<?php
session_start();
require_once "sqlHandler.php";
$id=$_SESSION['id'];
    try{
        $query="select * from cart where id=:x";
        $sqlHandler->half_genericQuery($query,1,array($id));
        $res=$sqlHandler->s->fetchAll();
        $yy=0;
        foreach($res as $res){
            $yy=$res['cart_id'];
        }
        $query="select * from animals,cart_item where cart_id=:x";

        $sqlHandler->half_genericQuery($query,1,array($yy));

        $sqlHandler->beginTransaction();
        $sqlHandler->commit();
    }catch(PDOException $e)
    {
        $sqlHandler->rollBack();
        throw $e;
    }
}

header("Location.php: shoppingCart.php");
exit(0);

?>
