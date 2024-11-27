<?php
session_start();
require 'db.php';

$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

if (count($cartItems) > 0) {
    $placeholders = implode(',', array_fill(0, count($cartItems), '?'));
    // Assuming the correct foreign key column in fproduct table is 'fid'
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
    <title>AgroCulture: Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="login.css"/>
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
		<link rel="stylesheet" href="indexfooter.css" />
    
</head>
<body style="background-color: #f7f7f7; padding: 20px;">
    <?php require 'menu.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Your chosen Products</h2>
        <?php if ($result && $result->num_rows > 0): ?>
            <div class="product-grid" style="display: flex; flex-wrap: wrap; justify-content: space-between; ">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4" style="border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);margin: left 5px;">
                        <div class="product-card" style="padding: 15px; margin-right:5px;">
                            <?php $picDestination = "images/productImages/" . $row['pimage']; ?>
                            <img src="<?php echo $picDestination; ?>" alt="Product Image" style="width: 100%; border-radius: 8px;">
                            <div class="card-body" style="padding-top: 15px;">
                                <h5 class="card-title" style="margin-bottom: 10px;"><?php echo $row['product']; ?></h5>
                                <p class="card-text" style="font-size: 14px; color: #555;">
                                    <strong>Type:</strong> <?php echo $row['pcat']; ?><br>
                                    <strong>Number:</strong> <?php echo $row['pnumber']; ?><br>
                                    <strong>Price:</strong> <?php echo $row['price']; ?> /-<br>
                                    <strong>Farmer:</strong> <?php echo $row['farmer_name']; ?><br>
                                    <strong>Mobile:</strong> <?php echo $row['farmer_mobile']; ?><br>
                                    <strong>Email:</strong> <?php echo $row['farmer_email']; ?><br>
                                    <strong>Address:</strong> <?php echo $row['farmer_address']; ?><br>
                                    <strong>Prodct info:</strong> <?php echo $row['pinfo']; ?><br>
                                </p>
                                <a href="removeFromCart.php?pid=<?php echo $row['pid']; ?>" class="btn custom-btn btn-danger">Remove</a>
<a href='myCart.php?pid=<?php echo $row['pid']; ?>' class="btn custom-btn btn-primary">Add to Cart</a>
<a href="index.php" class="btn custom-btn btn-secondary">Back</a>
<a href="productEdit.php" class="btn custom-btn btn-secondary">Edit</a>

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
