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
    require_once "sqlHandler.php"; 
    if(isset($_POST['submit'])){
    $sql="select * from users where binary name=:x and binary password=:y";
    //$s=$dbc->prepare($sql);
    $name=filter($name);
    $pass=filter($pass);
    $arr=array($name,$pass);
    //$s->bindValue(':name',$name);
    //$s->bindValue(':password',$pass);
    $sqlHandler->half_genericQuery($sql,2,$arr);
    //$s->execute();
    $result=$sqlHandler->s->fetchAll();
    echo $sqlHandler->s>rowCount();
    if($sqlHandler->s->rowCount() > 0)
    {
        session_start();
        $_SESSION['username']=$name;
        $_SESSION['user_id']=$result['id']; //adding session variable for id
        header("Location: index.php?success=1");

    }
    ////echo $_SESSION['user_id'];
    //header("Location: login.php?bad=1");
    exit(0);
    }
}
?>
