<?php
session_start();

?>

<html>
    <head>
    <link rel="stylesheet" type="text/css" href="style/style.css" />
        <title>
            login
        </title>
    </head>
    <body>
        
    <div class="headern">
        <header>
            <a href="site.php"><img src="../images/logo.png" width="400"></a>
            <form role="search" id="form">
                <input type="search" id="query" name="q"
                placeholder="Search..."
                aria-label="Search through site content">
                <button>
                <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
                </button>
            </form>
            <a href="login.php"> Login </a>
        </header>
    </div>
        <form method="post" action="loginCheck.php">
            <label>Username </label><input type="text" name=name /> </br>
            <label>Password </label><input type="text" name=pass /> </br>
            <input type="submit" name=submit /> </br>
        </form>
        <a href="register.php">Don't have a account register here</a>
    </body>


</html>
