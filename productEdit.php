<?php
session_start();
require 'db.php'; // Ensure your database connection is included

// Check if 'pid' is set in the URL
if (isset($_GET['pid'])) {
    $pid = $_GET['pid']; // Get the product ID from the URL

    // Query to fetch the product details based on the 'pid'
    $sql = "SELECT * FROM fproduct WHERE pid = '$pid'";
    $result = mysqli_query($conn, $sql); // Run the query

    // Check if a product was found
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result); // Fetch the product data
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "Invalid product ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require 'menu.php'; ?>

    <section id="one" class="wrapper style1 align-center">
        <div class="container">
            <form method="POST" action="updateProducts.php" enctype="multipart/form-data">
                <input type="hidden" name="pid" value="<?php echo $row['pid']; ?>"> <!-- Correct 'pid' -->
                <h2>Edit Product Information</h2>
                <br>
                <center>
                    <input type="file" name="productPic">
                    <br>
                    <?php if (!empty($row['pimage'])): ?>
                        <img src="images/productImages/<?php echo $row['pimage']; ?>" alt="Product Image" width="200">
                    <?php endif; ?>
                </center>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="select-wrapper" style="width: auto;">
                            <select name="type" id="type" required style="background-color:white;color: black;">
                                <option value="" style="color: black;">- Category -</option>
                                <option value="Fruit" <?php if ($row['pcat'] == 'Fruit') echo 'selected'; ?>>Fruit</option>
                                <option value="Vegetable" <?php if ($row['pcat'] == 'Vegetable') echo 'selected'; ?>>Vegetable</option>
                                <option value="Grains" <?php if ($row['pcat'] == 'Grains') echo 'selected'; ?>>Grains</option>
                                <option value="Animal" <?php if ($row['pcat'] == 'Animal') echo 'selected'; ?>>Animal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" name="pname" id="pname" value="<?php echo $row['product']; ?>" placeholder="Product Name" style="background-color:white;color: black;" />
                    </div>
                    <div class="col-sm-6">
                        <input type="text" name="pnumber" id="pnumber" value="<?php echo $row['pnumber']; ?>" placeholder="Product Number" style="background-color:white;color: black;" />
                    </div>
                    <div class="col-sm-6">
                        <input type="text" name="price" id="price" value="<?php echo $row['price']; ?>" placeholder="Price" style="background-color:white;color: black;" />
                    </div>
                </div>
                <br>
                <div>
                    <textarea name="pinfo" id="pinfo" rows="12"><?php echo $row['pinfo']; ?></textarea>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <button class="button fit" style="width:auto; color:black;">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script src="https://cdn.ckeditor.com/4.8.0/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('pinfo');
    </script>
</body>
</html>
