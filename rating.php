<?
require_once("sqlHandler.php");

$product_id = $_GET['product_id'];

if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
}

if(isset($_POST['submit_review'])){
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $review = mysqli_real_escape_string($conn, $_POST['review']);

    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO reviews (product_id, user_id, rating, review) VALUES ('$product_id', '$user_id', '$rating', '$review')";
    mysqli_query($conn, $sql);

    $sql = "SELECT AVG(rating) AS avg_rating FROM reviews WHERE product_id = '$product_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $avg_rating = $row['avg_rating'];

    // Round the average rating to the nearest 0.5
    $avg_rating = round($avg_rating * 2) / 2;

    $sql = "UPDATE products SET rating = '$avg_rating' WHERE id = '$product_id'";
    mysqli_query($conn, $sql);

    // Redirect to product page
    header("Location: product.php?product_id=$product_id");
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

    <label for="review">Review:</label>
    <textarea name="review" required></textarea>

    <input type="submit" name="submit_review" value="Submit Review">
</form>



