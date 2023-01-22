<?php
session_start();

function login($name,$pass){
    require_once "db/db.php"; 
    if(isset($_POST['submit'])){
    $sql="select * from users where binary name=:name and binary password=:password";
    $s=$dbc->prepare($sql);
    $s->bindValue(':name',$name);
    $s->bindValue(':password',$pass);
    $s->execute();
    $result=$s->fetchAll();
    
    if($s->rowCount() > 0)
    {
        session_start();
        $_SESSION['username']=$name;
        header("Location: index.php?success=1");
        exit(0);   
    }
    header("Location: login.php?bad=1");
    exit(0);
    }
}
/* 
 class accountHandler {

  // Methods
  function checkSession()
  {
    if(!(isset($_SESSION['username'])))
    {
        header("Location: login.php");
    }
    
  }
  function login($name,$password)
  {
    if(isset($_POST['submit']))
    {
      $sql="select * from users where binary name=:username and binary password=:password";
      $s=$dbc->prepare($sql);
      
    //  $name=htmlspecialchars($name);
    //  $name=addslashes($name);
    //  $password=$htmlspecalchars($password);
     // $password=addslashes($password);
      
      $s->bindValue(":username",$name);
      $s->bindValue(":password",$password);  
      $s->execute();     
      $result = $s->fetchAll();
     
      if($s->rowCount($result) > 0)
      {
        session_start();
        $_SESSION['username']=$name;
        header("Location: index.php");
        exit(0);
        //echo "test";
     //    session_start();
      //   $_SESSION['username']=$name;
       // $_SESSION['id']=$result['id'];
       // echo "test 123";
       // header("Location: index.php");
       // exit(0);
      }
     // header("Location: login.php?bad=1");
      //exit(0);
    } 
       

  }
}
$handler=new accountHandler();
*/
function filter($var)
{
 $var=htmlspecialchars($var);
 $var=addslashes($var);
 return $var;
}

/*function loginFunc($name,$password)
{
 // echo "debug test entering function";
  if(isset($_POST['submit'])){
  echo "enetering if statement";
  $sql="select * from users where binary name=:username and binary password=:password";
 // echo $name;
  $s=$dbc->prepare($sql);
  $s->bindValue(":username",$name);
  $s->bindValue(":password",$password);
  $s->execute();
  $result=$s->fetchAll();
  foreach($result as $result)
  {
    echo $result['id'];
  }
// echo $name." before";
//  $name=filter($name);
 // echo $name." after";
 // $password=filter($password);
  //$s->bindValue(":username",$name);
  //$s->bindValue(":password",$password);
  //$s->execute();
  //$result = $s->fetchAll();
 /* 
  if($s->rowCount($result) > 0)
  {
    echo "after rowcount";
    session_start();
    $_SESSION['username']=$name;
    echo $_SESSION['username'];
     header("Location: index.php");
    exit(0);
  }
  header("Location: login.php?");
  exit(0);  
  */  
  }
}*/


?>
