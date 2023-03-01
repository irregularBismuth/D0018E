<?
require_once("sqlHandler.php");

$product_id = $_GET['product_id'];

if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
}

if(isset($_POST['submit_rating'])){
$rating = $_POST['rating'];

$user_id = $SESSION['user_id'];
$sqlHandler->INSERT("SELECT AVG(rating) AS avg_rating FROM reviews WHERE product_id = ?");

$avg_rating = $row['avg_rating'];

$sqlHandler->FETCH("UPDATE products SET rating = ? WHERE id = ?");
$stmt->execute([$avg_rating, $product_id]);

exit;




}
?>
<form action="" method="post">
    <label for="rating">Rating:</label>
    <div class="star-rating">
        <input type="radio" name="rating" value="0.5" required><i></i>
        <input type="radio" name="rating" value="1"><i></i>
        <input type="radio" name="rating" value="1.5"><i></i>
        <input type="radio" name="rating" value="2"><i></i>
        <input type="radio" name="rating" value="2.5"><i></i>
        <input type="radio" name="rating" value="3"><i></i>
        <input type="radio" name="rating" value="3.5"><i></i>
        <input type="radio" name="rating" value="4"><i></i>
        <input type="radio" name="rating" value="4.5"><i></i>
        <input type="radio" name="rating" value="5"><i></i>
    </div>

    <input type="submit" name="submit_review" value="Submit Review">
</form>



