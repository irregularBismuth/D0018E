<?php
ob_start();
session_start();
$id=$_SESSION['id'];
function check($id)
{
require_once "sqlHandler.php";
    try{
       
        $query="select * from cart where customer_id=:x";
        $sqlHandler->half_genericQuery($query,1,array($id));
        $res=$sqlHandler->s->fetchAll(); 
        $yy=0;
        if($sqlHandler->s->rowCount() > 0){
            foreach($res as $res){
                $yy=$res['id'];
            }
        }
        else{ 
            return 2;
        }
        
        $dbcc=$sqlHandler->get_db_connector();
        $dbcc->beginTransaction();
    
        $condition_balance_check = false;
        $condition_check2 = false; 
        $condition_check3 = false;
        
        if ($condition_balance_check){

        }

        // if all transactional conditions evaluate to true then UPDATE-queries 
        if ($condition_balance_check & $condition_check2 & $condition_check3){

        }


        return 3;
      /*  $quer="select * from animals,cart_item where cart_item=:x";
        $sqlHandler->half_genericQuery($query,1,array($yy));
        $rez=$sqlHandler->s->fetchAll();
        $tot=0;
        foreach($rez as $rez){
            if($rez['product_id']==$rez['animal_id']){
                $tot+=$rez['quantity']*$rez['price'];
                if($rez['quantity'] > $rez['animal_quantity']){
                    return 3;
                }
            }
            
        }
       */ 
         
       // $sqlHandler->half_genericQuery($query,0,0);  
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
      return 0;  
   //     header("Location: shoppingCart.php");
    //     exit(0);
        //return true;
    }
    catch(PDOException $e)
    {
        $dbcc->rollBack();
       // echo ($e->getMessage());    
    }
}
$val=check($id);
if($val==0){
header("Location: shoppingCart.php");
exit(0);
}
if($val==1){
header("Location: shoppingCart.php?bad=1");
exit(0);
}

if($val==3){
header("Location: shoppingCart.php?bad=2");
exit(0);
}


?>
