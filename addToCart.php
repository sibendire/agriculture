<?php
session_start();
require 'db.php';

if (isset($_GET['pid'])) {
    $productId = $_GET['pid'];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    if (!in_array($productId, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $productId;
    }
}

header('Location: review.php');
exit();
?>
