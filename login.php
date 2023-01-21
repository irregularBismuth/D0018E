<?php
session_start();

?>

<html>
    <head>
        <title>
            login
        </title>
    </head>
    <body>
        <form action="loginCheck.php" method="POST">
            <label>Username </label><input type="text" name=uname /> </br>
            <label>Password </label><input type="password" name=passw /> </br>
            <input type="submit" name=submit /> </br>
        </form>
    </body>


</html>
