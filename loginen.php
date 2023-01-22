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
        <form method="post" action="loginCheck.php">
            <label>Username </label><input type="text" name=name /> </br>
            <label>Password </label><input type="password" name=pass /> </br>
            <input type="submit" name=submit /> </br>
        </form>
    </body>


</html>
