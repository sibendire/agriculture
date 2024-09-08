<?php
session_start();

if (isset($_GET['pid'])) {
    $productId = $_GET['pid'];
    
    if (isset($_SESSION['cart'])) {
        $key = array_search($productId, $_SESSION['cart']);
        if ($key !== false) {
            unset($_SESSION['cart'][$key]);
        }
    }
}

header('Location: review.php');
exit();
?>
