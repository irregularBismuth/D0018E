<?php
session_start();
require_once("sqlHandler.php");

$product_id = $_POST['product_id'];

if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
}

if(isset($_POST['submit_rating'])){
    $rating = $_POST['rating'];
    $user_id = $_SESSION['user_id'];

    $sqlHandler->execute("INSERT INTO reviews (product_id, user_id, rating) VALUES (?, ?, ?)", [$product_id, $user_id, $rating]);

    $row = $sqlHandler->FETCH("SELECT AVG(rating) AS avg_rating FROM reviews WHERE product_id = ?", [$product_id]);
    $avg_rating = $row['avg_rating'];
    $sqlHandler->execute("UPDATE products SET rating = ? WHERE id = ?", [$avg_rating, $product_id]);

    header('Location: product.php?id=' . $product_id);
    exit;
}

?>



