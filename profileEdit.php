<?php
	session_start();
	require 'db.php';
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
    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
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
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
    <section id="updateProfile" style="width: 100%; max-width: 400px; background-color: #ffffff; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border-radius: 10px;">
        <h2 style="text-align: center; color: #343a40; margin-bottom: 20px;">Update Your Data</h2>
        <form method="post" action="Profile/updateProfile.php">
            <div style="display: flex; flex-direction: column; gap: 10px;">
                <div>
                    <input type="text" name="name" id="name" value="<?php echo $_SESSION['fname'];?>" placeholder="Full Name" required style="width: 100%; padding: 12px; border: 1px solid #ced4da; border-radius: 5px; box-sizing: border-box;">
                </div>
                <div>
                    <input type="text" name="mobile" id="mobile" value="<?php echo $_SESSION['fmobile'];?>" placeholder="Mobile No" required style="width: 100%; padding: 12px; border: 1px solid #ced4da; border-radius: 5px; box-sizing: border-box;">
                </div>
                <div>
                    <input type="text" name="uname" id="uname" value="<?php echo $_SESSION['Username'];?>" placeholder="Username" required style="width: 100%; padding: 12px; border: 1px solid #ced4da; border-radius: 5px; box-sizing: border-box;">
                </div>
                <div>
                    <input type="email" name="email" id="email" value="<?php echo $_SESSION['Email'];?>" placeholder="Email" required style="width: 100%; padding: 12px; border: 1px solid #ced4da; border-radius: 5px; box-sizing: border-box;">
                </div>
                <div style="text-align: center; margin-top: 20px;">
                    <input type="submit" class="button special" value="Update Profile" style="padding: 12px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                </div>
            </div>
        </form>
    </section>
</body>
</html>
