<?php
ob_start();
session_start();

if(!(isset($_SESSION['id'])))
{
    header("Location: login.php?bad=2");
    exit(0);
}

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
         
        $query="select * from animals,cart_item where animal_id=product_id and where cart_id=:x";
        $sqlHandler->half_genericQuery($query,1,array($yy));
        $rez=$sqlHandler->s->fetchAll();
        $tot=0;
        foreach($rez as $rez){
                $tot+=$rez['quantity']*$rez['price'];
                if($rez['quantity'] > $rez['animal_quantity']){
                    return 3;
                }
        }
        
         
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
if($val==2){
header("Location: shoppingCart.php?bad=2");
exit(0);
}
if($val==3){
header("Location: shoppingCart.php?bad=3");
exit(0);
}


?>
