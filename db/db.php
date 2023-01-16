<?php
session_start();
require_once "form.php";
try {
    $dbc=new PDO("mysql:host=$dbhost;dbname=$dbname;",$dbuser,$dbpassword);
} catch (PDOexception $e) {
  echo "Login to database failed".$e->getMessage()."\n"; 
  exit(0);
}

?>
