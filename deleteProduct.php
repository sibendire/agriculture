<?php
session_start();
require 'db.php'; // Ensure your database connection is included

// Check if 'pid' is set in the URL
if (isset($_GET['pid'])) {
    $productId = $_GET['pid'];

    // Prepare and execute the DELETE query to remove the product from the database
    $sql = "DELETE FROM fproduct WHERE pid = ?";
    
    // Prepare the statement to prevent SQL injection
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind the product ID to the prepared statement
        mysqli_stmt_bind_param($stmt, "i", $productId);
        
        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            // Optionally, remove the product from the session cart if it's there
            if (isset($_SESSION['cart'])) {
                $key = array_search($productId, $_SESSION['cart']);
                if ($key !== false) {
                    unset($_SESSION['cart'][$key]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the cart array
                }
            }
            // Redirect to the review page after deletion
            header('Location: review.php');
            exit();
        } else {
            echo "Error deleting product from database.";
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the SQL query.";
    }
} else {
    echo "Product ID not provided.";
}

?>
