<?php
session_start();
require_once("db/db.php");
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

function login($name,$password)
{
  if(isset($_POST['submit'])){
  $sql="select * from users where binary name=:username and binary password=:password";
  $s=$dbc->prepare($sql);
  $name=filter($name);
  $password=filter($password);
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
  }
  header("Location: login.php?");
  exit(0);  
  } 
}


?>