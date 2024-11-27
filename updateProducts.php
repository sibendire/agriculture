<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure 'pid' is being sent and accessible
    if (isset($_POST['pid'])) {
        $productId = $_POST['pid'];
    } else {
        $_SESSION['message'] = "Product ID is missing.";
        header("Location: Login/error.php");
        exit();
    }

    // Sanitize input data
    $productName = dataFilter($_POST['pname']);
    $productType = $_POST['type'];
    $pnumber = dataFilter($_POST['pnumber']);
    $productPrice = dataFilter($_POST['price']);
    $productInfo = $_POST['pinfo'];

    // Update product details (use 'pid' instead of 'id')
    $sql = "UPDATE fproduct SET product=?, pcat=?, pinfo=?, price=?, pnumber=? WHERE pid=?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        $_SESSION['message'] = "Error in prepare(): " . $conn->error;
        header("Location: Login/error.php");
        exit();
    }
    
    $stmt->bind_param("ssssii", $productName, $productType, $productInfo, $productPrice, $pnumber, $productId);

    if ($stmt->execute()) {
        // Handle image update if a new image is uploaded
        if (!empty($_FILES['productPic']['name'])) {
            $pic = $_FILES['productPic'];
            $picExt = strtolower(pathinfo($pic['name'], PATHINFO_EXTENSION));
            $allowed = array('jpg', 'jpeg', 'png');

            if (in_array($picExt, $allowed)) {
                $picNameNew = $productName . "_" . $productId . "." . $picExt;
                $picDestination = "images/productImages/" . $picNameNew;

                if (move_uploaded_file($pic['tmp_name'], $picDestination)) {
                    $sql = "UPDATE fproduct SET pimage=? WHERE pid=?";
                    $updateStmt = $conn->prepare($sql);
                    
                    if ($updateStmt === false) {
                        $_SESSION['message'] = "Error in prepare(): " . $conn->error;
                        header("Location: Login/error.php");
                        exit();
                    }
                    
                    $updateStmt->bind_param("si", $picNameNew, $productId);
                    $updateStmt->execute();
                }
            }
        }

        $_SESSION['message'] = "Product updated successfully!";
        header("Location: index.php");
    } else {
        $_SESSION['message'] = "Failed to update product.";
        header("Location: Login/error.php");
    }
}

function dataFilter($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>
