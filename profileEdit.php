<?php
	session_start();
	require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Update Farmer Profile</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/customStyles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="indexfooter.css" />
</head>
<body>
	<section id="updateProfile" style="max-width: 400px; margin: auto; padding: 20px; background-color: #f7f7f7; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);">
		<h2>Update Your Profile</h2>
		<form method="POST" action="Profile/updateProfile.php">
			<div class="form-group">
				<input type="text" name="name" id="name" value="<?php echo $_SESSION['Name']; ?>" placeholder="Full Name" class="form-control" required>
			</div>
			<div class="form-group">
				<input type="text" name="mobile" id="mobile" value="<?php echo $_SESSION['Mobile']; ?>" placeholder="Mobile No" class="form-control" required>
			</div>
			<div class="form-group">
				<input type="text" name="uname" id="uname" value="<?php echo $_SESSION['Username']; ?>" placeholder="Username" class="form-control" required>
			</div>
			<div class="form-group">
				<input type="email" name="email" id="email" value="<?php echo $_SESSION['Email']; ?>" placeholder="Email" class="form-control" required>
			</div>
			<div class="form-group">
				<input type="text" name="addr" id="addr" value="<?php echo $_SESSION['Addr']; ?>" placeholder="Address" class="form-control">
			</div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Update Profile">
			</div>
		</form>
	</section>
</body>
</html>
