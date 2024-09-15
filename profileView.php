
<?php
    session_start();

	if(!isset($_SESSION['logged_in']) OR $_SESSION['logged_in'] != 1)
	{
		$_SESSION['message'] = "You have to Login to view this page!";
		header("Location: Login/error.php");
	}
?>

<!DOCTYPE HTML>

<html lang="en">
    <head>
        <title>Profile: <?php echo $_SESSION['Username']; ?></title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap\js\bootstrap.min.js"></script>
        <meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="login.css"/>
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/style-xlarge.css" />

    </head>


    <body>

        <?php
            require 'menu.php';
        ?>

<section id="one" class="wrapper style1 align" style="padding: 50px 0; background-color: #f9f9f9;">
    <div class="inner">
        <div class="box" style="background-color: #fff; padding: 40px; border-radius: 10px; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);">
            <header style="text-align: center; margin-bottom: 30px;">
                <img src="<?php echo 'images/profileImages/'.$_SESSION['picName'].'?'.mt_rand(); ?>" class="image-circle" alt="Profile Image" style="border-radius: 50%; width: 200px; height: 200px; object-fit: cover;">
                <h2 style="margin-top: 20px;"><?php echo $_SESSION['Name'];?></h2>
                <h4 style="color: #777; margin-bottom: 0;"><?php echo $_SESSION['Username'];?></h4>
            </header>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-sm-6">
                    <p style="font-size: 18px; color: #444; margin-bottom: 15px;t"><strong>Ratings:</strong> <?php echo $_SESSION['Rating'];?></p>
                    <p style="font-size: 18px; color: #444; margin-bottom: 0;"><strong>Email:</strong> <?php echo $_SESSION['Email'];?></p>
                </div>
                <div class="col-sm-6">
                    <p style="font-size: 18px; color: #444; margin-bottom: 15px;"><strong>Mobile:</strong> <?php echo $_SESSION['Mobile'];?></p>
                    <p style="font-size: 18px; color: #444; margin-bottom: 0;"><strong>Address:</strong> <?php echo $_SESSION['Addr'];?></p>
                </div>
            </div>
            <div class="row" style="margin-top: 30px;">
                 <div class="col-sm-4">
                    <a href="profileEdit.php" class="btn btn-primary btn-block" style="text-decoration: none; font-size: 16px; padding: 12px; border-radius: 30px;">Edit Profile</a>
                </div> 
                <div class="col-sm-4">
                    <a href="uploadProduct.php" class="btn btn-primary btn-block" style="text-decoration: none; font-size: 16px; padding: 12px; border-radius: 30px;">Upload Product</a>
                </div>
                <div class="col-sm-4">
                    <a href="Login/logout.php" class="btn btn-danger btn-block" style="text-decoration: none; font-size: 16px; padding: 12px; border-radius: 30px;">LOG OUT</a>
                </div>
            </div>
        </div>
    </div>
</section>




        <!-- Scripts -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/jquery.scrolly.min.js"></script>
            <script src="assets/js/jquery.scrollex.min.js"></script>
            <script src="assets/js/skel.min.js"></script>
            <script src="assets/js/util.js"></script>
            <script src="assets/js/main.js"></script>



    </body>
</html>
