<?php
session_start();
require 'db.php';

// Retrieve cart items from session
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

if (count($cartItems) > 0) {
    // Prepare placeholders for SQL query
    $placeholders = implode(',', array_fill(0, count($cartItems), '?'));
    
    // Query to fetch product and farmer details
    $sql = "
        SELECT fproduct.*, 
               farmer.fname AS farmer_name, 
               farmer.fmobile AS farmer_mobile, 
               farmer.femail AS farmer_email, 
               farmer.faddress AS farmer_address 
        FROM fproduct 
        JOIN farmer ON fproduct.fid = farmer.fid 
        WHERE fproduct.pid IN ($placeholders)
    ";
    
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error);
    }
    
    // Bind parameters dynamically
    $stmt->bind_param(str_repeat('i', count($cartItems)), ...$cartItems);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AgroCulture: Your Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="login.css"/>
    <link rel="stylesheet" href="indexfooter.css"/>
    <style>
        body {
            background-color: #f7f7f7;
            padding: 20px;
        }
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .product-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 15px 0;
            padding: 15px;
        }
        .product-card img {
            width: 100%;
            border-radius: 8px;
        }
        .product-card .card-body {
            padding-top: 15px;
        }
        .product-card .custom-btn {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <?php require 'menu.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Your Chosen Products</h2>
        <?php if ($result && $result->num_rows > 0): ?>
            <div class="product-grid">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="product-card">
                            <?php $picDestination = "images/productImages/" . htmlspecialchars($row['pimage']); ?>
                            <img src="<?php echo $picDestination; ?>" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['product']); ?></h5>
                                <p class="card-text">
                                    <strong>Type:</strong> <?php echo htmlspecialchars($row['pcat']); ?><br>
                                    <strong>Number:</strong> <?php echo htmlspecialchars($row['pnumber']); ?><br>
                                    <strong>Price:</strong> <?php echo htmlspecialchars($row['price']); ?> /-<br>
                                    <strong>Farmer:</strong> <?php echo htmlspecialchars($row['farmer_name']); ?><br>
                                    <strong>Mobile:</strong> <?php echo htmlspecialchars($row['farmer_mobile']); ?><br>
                                    <strong>Email:</strong> <?php echo htmlspecialchars($row['farmer_email']); ?><br>
                                    <strong>Address:</strong> <?php echo htmlspecialchars($row['farmer_address']); ?><br>
                                    <strong>Product Info:</strong> <?php echo htmlspecialchars($row['pinfo']); ?>
                                </p>
                                <a href="removeFromCart.php?pid=<?php echo $row['pid']; ?>" class="btn custom-btn btn-danger">Remove</a>
                                <a href="myCart.php?pid=<?php echo $row['pid']; ?>" class="btn custom-btn btn-primary">Add to Cart</a>
                                <a href="index.php" class="btn custom-btn btn-secondary">Back</a>
                                <a href="productEdit.php" class="btn custom-btn btn-warning">Edit</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-center" style="font-size: 18px; color: #555;">Hello! You have not selected any item yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>
