<?php
session_start();
ob_start();
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
       /* $query="select * from cart where customer_id=:x";
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
        }*/
        
        $dbcc=$sqlHandler->get_db_connector();
        $dbcc->beginTransaction();   
        
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
     
        $wer="insert into ode(customer_id,total) values(:x,:y)";
        $sqlHandler->half_genericQuery($wer,2,array($id,0));
        //global $ide;
        $ide=$dbcc->lastInsertId(); 


        $line="select * from animals,cart_item where animal_id=product_id and cart_id=:x";
        $sqlHandler->half_genericQuery($line,1,array($yy));
        $z=$sqlHandler->s->fetchAll();
        $tot=0;
        foreach($z as $z){
            $tot+=$z['price']*$z['quantity'];
            if($z['quantity'] > $z['animal_quantity']){
                return 1;
            }
            $quant=($z['animal_quantity']-$z['quantity']);
            $link="update animals set animal_quantity=:x where animal_id=:y";
            $sqlHandler->half_genericQuery($link,2,array($quant,$z['animal_id']));

            $quary="insert into ode_item(odeid,product_id,price,quantity) values(:x,:y,:z,:w)";
            $sqlHandler->half_genericQuery($quary,4,array($ide,$z['product_id'],$z['price'],$z['quantity']));
        }
        $yama="update ode set total=:x where id=:y";
        $sqlHandler->half_genericQuery($yama,2,array($tot,$ide));
        $serifu="select * from users where id=:x";
        $sqlHandler->half_genericQuery($serifu,1,array($id));
        $w=$sqlHandler->s->fetchAll();
        $bal=0;
        foreach($w as $w){
            $bal=$w['balance'];
        } 
        $cost=$bal - $tot;
        if(!($cost > 0))
        {
            return 3;
        }
        $lou="update users set balance=:x where id=:y";
        $sqlHandler->half_genericQuery($lou,2,array($cost,$id));  
       
        $milkers="delete from cart_item where cart_id=:x";    
        $sqlHandler->half_genericQuery($milkers,1,array($yy));

        /* $milker="set foreign_key_checks=:x";
            $sqlHandler->half_genericQuery($milker,1,array(0));
        $milkers="delete from cart_item where cart_id=:x";
            $sqlHandler->half_genericQuery($milkers,1,array($yy));
        $milkerz="delete from cart where id=:x";
            $sqlHandler->half_genericQuery($milkerz,1,array($yy)); 
        $sqlHandler->half_genericQuery($milker,1,array(1)); 
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
       echo ($e->getMessage());    
    }
}

$val=check($_SESSION['id']);
if($val==0){
header("Location: shoppingCart.php?succ=1");
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
