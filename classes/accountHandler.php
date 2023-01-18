<?php
session_start();
class accountHandler {
  private $name;

  // Methods
  function checkSession()
  {
    if(!(isset($_SESSION['username'])))
    {
        header("Location: login.php");
    }
    
  }
}
$handler=new accountHandler();
echo "123";
?>
