<?php
	session_start();
	require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Update Farmer Profile</title>

	<!-- Bootstrap CSS -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

	<!-- Optional Google Fonts for better typography -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

	<!-- Custom Styles -->
	<link rel="stylesheet" href="css/customStyles.css">

	<!-- jQuery and Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

	<!-- Additional Footer Styling -->
	<link rel="stylesheet" href="indexfooter.css" />
</head>
<body style="font-family: 'Roboto', sans-serif; background-color: #f5f5f5;">

	<!-- Profile Update Section -->
	<section id="updateProfile" class="container mt-5" style="max-width: 500px; margin: auto;">
		<div class="card shadow-lg">
			<div class="card-body">
				<h2 class="text-center mb-4" style="font-size: 24px; font-weight: 500;">Update Your Profile</h2>
				<form method="POST" action="Profile/updateProfile.php">
					<div class="form-group">
						<label for="name">Full Name</label>
						<input type="text" name="name" id="name" value="<?php echo $_SESSION['Name']; ?>" placeholder="Full Name" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile">Mobile No</label>
						<input type="text" name="mobile" id="mobile" value="<?php echo $_SESSION['Mobile']; ?>" placeholder="Mobile No" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="uname">Username</label>
						<input type="text" name="uname" id="uname" value="<?php echo $_SESSION['Username']; ?>" placeholder="Username" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" id="email" value="<?php echo $_SESSION['Email']; ?>" placeholder="Email" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="addr">Address</label>
						<input type="text" name="addr" id="addr" value="<?php echo $_SESSION['Addr']; ?>" placeholder="Address" class="form-control">
					</div>
					<div class="text-center">
						<button type="submit" class="btn btn-primary btn-lg btn-block mt-3">Update Profile</button>
					</div>
				</form>
			</div>
		</div>
	</section>

</body>
</html>
