<?php
session_start();
$id=$_SESSION['id'];
function check()
{
require_once "sqlHandler.php";
    try{
       
  /*      $query="select * from cart where customer_id=:x";
        $sqlHandler->half_genericQuery($query,1,array($id));
        $res=$sqlHandler->s->fetchAll();
        $yy=0;
        foreach($res as $res){
            $yy=$res['id'];
        }
   */
         $dbcc=$sqlHandler->get_db_connector();
        $dbcc->beginTransaction();
        
        $query="insert into cart(customer_id) values(7)";
        $sqlHandler->half_genericQuery($query,0,0);  
 /*    $query="select * from animals,cart_item where cart_id=:x";
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
        */
        $dbcc->commit();
    }
    catch(PDOException $e)
    {
        $dbcc->rollBack();
        echo ($e->getMessage());    
    }
}
check();

header("Location.php: shoppingCart.php");
exit(0);

?>
