<?php
session_start();
require_once "sqlHandler.php";
$quer="delete from animals where id=:x";
$anmid=$_POST['animalid'];







?>
