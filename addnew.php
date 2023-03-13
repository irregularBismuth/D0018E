<?php
session_start();
if($_SESSION['admin']!=1)
{
    header("Location: productPage.php");
    exit(0);
}
?>
<form action='addNewFun.php' method='post'>
    <label>Animal_name</label><input type='text' name='aname'/>
    <label>Animal_img url</label><input type='text' name='aurl' />
    <label>Animal_comment</label><input type='text' size='44' name='acom' />
    <label>Animal_price</label><input type='number' name='anum' min='10' max='1000000'/>
   <label>How many?</label><input type='number' name='hman' min='1' max='1000' />
     <input type='submit'>
</form>








