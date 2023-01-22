<?php

function logout()
{
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit(0);
}

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
?>
