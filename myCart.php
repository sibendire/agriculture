<?php
session_start();
require 'db.php';

$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

if (count($cartItems) > 0) {
    $placeholders = implode(',', array_fill(0, count($cartItems), '?'));
    $stmt = $conn->prepare("SELECT * FROM fproduct WHERE pid IN ($placeholders)");
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
    <meta name="description" content="Review your selected products in the cart">
    <meta name="keywords" content="AgroCulture, products, cart, review">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/customStyles.css">
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
    <script>
        function showBuyNowForm(pid) {
            document.getElementById('buyNowForm').style.display = 'block';
            document.getElementById('pid').value = pid;
        }
    </script>

<style>
        /* Styles for Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            max-width: 600px;
            width: 90%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<div class="container mt-5" style="margin-top: 20px;">
        <h2 class="text-center mb-4">Your chosen Products</h2>
        <?php if ($result && $result->num_rows > 0): ?>
        <div class="row" style="display: flex; flex-wrap: wrap;">
            <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-3" style="flex: 0 0 33.333%; max-width: 33.333%;">
                <div class="card h-100" style="border: 1px solid #ddd; border-radius: 5px;">
                    <?php $picDestination = "images/productImages/" . $row['pimage']; ?>
                    <img src="<?php echo $picDestination; ?>" class="card-img-top" alt="Product Image" style="width: 100%; height: auto;">
                    <div class="card-body" style="padding: 20px;">
    <h5 class="card-title" style="margin-bottom: 10px;"><?php echo $row['product']; ?></h5>
    <p class="card-text" style="margin-bottom: 10px;">
        <strong>Type:</strong> <?php echo $row['pcat']; ?><br>
        <strong>Number:</strong> <?php echo $row['pnumber']; ?><br>
        <strong>Price:</strong> <?php echo $row['price']; ?> /-
    </p>

<!-- Buttons for Remove, Buy Now, and Back in one line -->
<div class="d-flex justify-content-between align-items-center" style="gap: 10px;">
    <a href="removeFromCart.php?pid=<?php echo $row['pid']; ?>" 
       class="btn btn-danger" 
       style="flex: 1; padding: 12px 0; text-align: center; width: 30%;">
       Remove
    </a>
    
    <button class="btn btn-primary" 
            onclick="showBuyNowForm(<?php echo $row['pid']; ?>)" 
            style="flex: 1; padding: 12px 0; text-align: center; width: 30%;">
        Order
    </button>
    
    <a href="index.php" 
       class="btn btn-secondary" 
       style="flex: 1; padding: 12px 0; background-color: #6c757d; color: #fff; border: none; border-radius: 5px; text-decoration: none; text-align: center; width: 30%;">
       Back
    </a>
</div>


</div>

                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php else: ?>
        <p class="text-center">Hello! You have not selected any item yet.</p>
        <a href="index.php" class="btn btn-primary" style="margin-top: 10px;">Back</a>
        <?php endif; ?>

    </div>
   
    

  <!-- Modal for Buy Now Form -->
  <div id="buyNowModal" class="modal d-flex">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form method="post" action="buyNow.php">
                <input type="hidden" name="pid" id="pid" value="">
                <h2 style="text-align: center;">Enter Your Details</h2>

                <!-- Name and City -->
                <div style="display: flex; justify-content: space-between; gap: 20px; margin-bottom: 20px;">
                    <div style="width: 48%;">
                        <input type="text" name="name" id="name" placeholder="Name" required 
                            style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                    </div>
                    <div style="width: 48%;">
                        <input type="text" name="city" id="city" placeholder="City" required 
                            style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                    </div>
                </div>

                <!-- Mobile Number and Email -->
                <div style="display: flex; justify-content: space-between; gap: 20px; margin-bottom: 20px;">
                    <div style="width: 48%;">
                        <input type="text" name="mobile" id="mobile" placeholder="Mobile Number" required 
                            style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                    </div>
                    <div style="width: 48%;">
                        <input type="email" name="email" id="email" placeholder="Email" required 
                            style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                    </div>
                </div>

                <!-- Address -->
                <div style="margin-bottom: 20px;">
                    <input type="text" name="addr" id="addr" placeholder="Address" 
                        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                </div>

                <!-- Quantity -->
                <div style="margin-bottom: 30px;">
                    <input type="number" name="quantity" id="quantity" value="0" min="0" placeholder="Quantity" required 
                        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                </div>

                <!-- Submit Button -->
                <center>
                    <input type="submit" value="Confirm Order" 
                        style="width: 50%; background-color: #007bff; color: #fff; cursor: pointer; padding: 12px; border: none; border-radius: 4px; font-size: 16px;">
                </center>
            </form>
        </div>
    </div>

 <!-- JavaScript for Modal -->
 <script>
        function showBuyNowForm(pid) {
            var modal = document.getElementById('buyNowModal');
            document.getElementById('pid').value = pid;
            modal.style.display = "flex"; // Show modal
        }

        function closeModal() {
            var modal = document.getElementById('buyNowModal');
            modal.style.display = "none"; // Hide modal
        }

        // Close modal if clicked outside the modal content
        window.onclick = function(event) {
            var modal = document.getElementById('buyNowModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/jquery.scrollex.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
