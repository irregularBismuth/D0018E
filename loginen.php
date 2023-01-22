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
        <form method="post" action="loginChecken.php">
            <label>Username </label><input type="text" name=name /> </br>
            <label>Password </label><input type="text" name=pass /> </br>
            <input type="submit" name=submit /> </br>
        </form>
    </body>


</html>
