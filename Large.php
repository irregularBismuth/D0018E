<!DOCTYPE html>
<html>
<style>

</style>

<header>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
 
    <a href="site.php"><img src="logo.png" width="400"></a>
 
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
<body>

<table style="border:1px solid black;margin-left:auto;margin-right:auto;width:50%;">
        <tr>
            <th><a href="cats.php">Cats</a></th>
            <th>Large animals</th>
            <th>Small animals</th>
            <th>About us</th>
        </tr>

<form>
</table>

<table style="border:1px solid black;margin-left:auto;margin-right:auto;">
    <tr>
        <td><img src="large/hippo.jpg" width="451" height="342"></a></td>
        <td>Hippo 72 986kr</td>
    </tr>
    <tr>
        <td><img src="large/elefant.jpg"width="451" height="342"></td>
        <td>Elephant 128 699kr</td>
    </tr>
    <tr>
        <td><img src="large/rhino.jpg"width="451" height="342"></td>
        <td>Rhino 15 886kr</td>
    </tr>
    <tr>
        <td><img src="large/giraffe.jpg"width="451" height="342"></a></td>
        <td>Tall boy 69 420kr</td>
    </tr>
</table>
<?php
echo "Hello World!";
?>

</body>