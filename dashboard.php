<?php 
session_start();
require 'db.php'; 

// Debugging session data
// echo '<pre>';
// print_r($_SESSION);  // Check the session contents
// echo '</pre>';
require 'menu.php';
// Ensure the user is logged in before accessing the dashboard
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Use 'id' as the farmer's ID from the session
if (isset($_SESSION['id'])) {
    $farmerId = $_SESSION['id']; // Retrieve the farmer's ID
} else {
    // Handle the error if 'id' is not found in session
    echo "Farmer ID not found in session!";
    exit();
}

// Determine the filter type and build the query
if (!isset($_GET['type']) || $_GET['type'] == "all") {
    $sql = "SELECT * FROM fproduct WHERE fid = '$farmerId'";
} elseif ($_GET['type'] == "fruit") {
    $sql = "SELECT * FROM fproduct WHERE fid = '$farmerId' AND pcat = 'Fruit'";
} elseif ($_GET['type'] == "vegetable") {
    $sql = "SELECT * FROM fproduct WHERE fid = '$farmerId' AND pcat = 'Vegetable'";
} elseif ($_GET['type'] == "animals") {
    $sql = "SELECT * FROM fproduct WHERE fid = '$farmerId' AND pcat = 'Animals'";
} elseif ($_GET['type'] == "grain") {
    $sql = "SELECT * FROM fproduct WHERE fid = '$farmerId' AND pcat = 'Grains'";
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AgroPreneur Farm System</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
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

<body>

<section id="main" class="style1 align-center">
    <div class="container">
        <h2 style="text-align: center; color: #006600; font-size:32px">AGROPRENEUR DIGITAL MAR</h2>
        <p style="text-align: center; font-size: 18px; line-height: 1.6; color: #333; border:1px solid #006600; background:#006600; color:white; font-size:18px">
            Welcome to AgroPreneur, the premier digital marketplace revolutionizing agribusiness. Connect with farmers, suppliers, and buyers seamlessly.
            <br>Our user-friendly interface and robust security ensure endless opportunities for growth. <br>Join us and embark on a journey of innovation and prosperity in agriculture.
        </p>

        <?php
        if (isset($_GET['n']) AND $_GET['n'] == 1):
        ?>
        <h3>Select Filter</h3>
        <form method="GET" action="productMenu.php?">
            <input type="text" value="1" name="n" style="display: none;"/>
            <center>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-2">
                        <div class="select-wrapper" style="width: auto">
                            <select name="type" id="type" required style="background-color:white;color: black;">
                                <option value="all" style="color: black;">List All</option>
                                <option value="fruit" style="color: black;">Fruit</option>
                                <option value="vegetable" style="color: black;">Vegetable</option>
                                <option value="grain" style="color: black;">Grains</option>
                                <option value="animals" style="color: black;">Animals</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <input class="button special" type="submit" value="Go!" />
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </center>
        </form>
        <?php endif; ?>

        <section id="two" class="style2 align-center">
            <div class="container">
                <div class="row">
                    <?php
                    while ($row = $result->fetch_array()):
                        $picDestination = "images/productImages/" . $row['pimage'];
                    ?>
                    <div class="col-md-4">
                        <section>
                            <strong><h2 class="title" style="color:black;"><?php echo $row['product']; ?></h2></strong>
                            <a href="review.php?pid=<?php echo $row['pid']; ?>"><img class="image fit" src="<?php echo $picDestination; ?>" height="220px;" /></a>

                            <div style="align: left">
                                <?php echo "Number : " . $row['pnumber']; ?>
                            </div>

                            <div style="align: left">
                                <blockquote><?php echo "Type : " . $row['pcat']; ?><br><?php echo "Price : " . $row['price'] . ' /-'; ?></blockquote>
                            </div>

                            <a href="addToCart.php?pid=<?php echo $row['pid']; ?>" class="btn custom-btn btn-primary">Product Detail</a>
                            <a href="productEdit.php?pid=<?php echo $row['pid']; ?>" class="btn custom-btn btn-secondary">Edit</a>
                            <a href="deleteproduct.php?pid=<?php echo $row['pid']; ?>" class="btn custom-btn btn-danger">Delete</a>
                        </section>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    </div>
</section>

</body>

<!-- Footer -->
<footer class="footer-distributed" style="background-color:black" id="aboutUs">
    <center>
        <h1 style="font: 35px calibri;">About Us</h1>
    </center>
    <div class="footer-left">
        <h3 style="font-family: 'Times New Roman', cursive;">AgroPreneur &copy; 2024</h3>
        <br />
        <p style="font-size:20px;color:white">Your product Our market !!!</p>
        <p style="font-size:20px;color:white">By Kephas and Friends</p>
        <br />
    </div>
    <div class="footer-center">
        <div>
            <i class="fa fa-map-marker"></i>
            <p style="font-size:20px">Agro Preneur Farm<span></span></p>
        </div>
        <div>
            <i class="fa fa-phone"></i>
            <p style="font-size:20px">0789742831</p>
        </div>
        <div>
            <i class="fa fa-phone"></i>
            <p style="font-size:20px">0789311009</p>
        </div>
    </div>

    <div class="footer-right">
        <p class="footer-company-about" style="color:white">
            <span style="font-size:20px"><b>About AgroPreneur</b></span>
            AgroPreneur is an e-commerce trading platform for grains & groceries...
        </p>
        <div class="footer-icons">
            <a href="#"><i style="margin-left: 0;margin-top:5px;" class="fa fa-facebook"></i></a>
            <a href="#"><i style="margin-left: 0;margin-top:5px" class="fa fa-instagram"></i></a>
            <a href="#"><i style="margin-left: 0;margin-top:5px" class="fa fa-youtube"></i></a>
        </div>
    </div>
</footer>

</html>
