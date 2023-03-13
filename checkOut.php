<?php
session_start();
require_once "sqlHandler.php";
$id=$_SESSION['id'];
    try{
       
        $query="select * from cart where customer_id=:x";
        $sqlHandler->half_genericQuery($query,1,array($id));
        $res=$sqlHandler->s->fetchAll();
        $yy=0;
        foreach($res as $res){
            $yy=$res['id'];
        }
        $sqlHandler->beginTransaction();
        $query="select * from animals,cart_item where cart_id=:x";
        $sqlHandler->half_genericQuery($query,1,array($yy));
        $rez=$sqlHandler->s->fetchAll();
        $tot=0;
        foreach($rez as $rez){
            if($rez['product_id']==$rez['animal_id'])
            {
                $tot+=$rez['quantity']*$rez['price']; 
                
            }
        }

        if($tot > 100){
            return false; 
            header("Location: shoppingCart.php?bad=1");
            exit(0);
        }
        
        

        $sqlHandler->commit();
    }catch(Exception $e)
    {
        $sqlHandler->rollBack();
        die($e->getMessage());    
    }
}

header("Location.php: shoppingCart.php");
exit(0);

?>
