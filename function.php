<?php

function filter($var)
{
    $var=htmlspecialchars($var);
    $var=addslashes($var);
    return $var;
}

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
        $_SESSION['user_id']=$result['id']; //adding session variable for id
        header("Location: index.php?success=1");

    }
    header("Location: login.php?bad=1");
    exit(0);
    }
}
?>
