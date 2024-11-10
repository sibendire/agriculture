<?php
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != 1) {
        $_SESSION['message'] = "You need to log in to view this page!";
        header("Location: Login/error.php");
        exit();
    }

    // Default profile image if none is provided
    $profileImage = !empty($_SESSION['picName']) ? htmlspecialchars($_SESSION['picName']) : 'default.jpg';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile: <?php echo htmlspecialchars($_SESSION['Username']); ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="css/skel.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-xlarge.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Additional Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-layers.min.js"></script>
    <script src="js/init.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS for Profile Page -->
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .profile-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-header img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 4px solid #ddd;
        }

        .profile-header h2 {
            margin-top: 15px;
            font-weight: bold;
            color: #333;
        }

        .profile-header h4 {
            color: #777;
        }

        .profile-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .profile-details p {
            font-size: 16px;
            color: #555;
        }

        .btn-custom {
            font-size: 16px;
            padding: 12px 20px;
            border-radius: 30px;
            width: 100%;
        }

        .btn-primary-custom {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary-custom:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-danger-custom {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger-custom:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>

<body>

    <?php include 'menu.php'; ?>

    <div class="profile-container">
        <div class="profile-header">
            <!-- Display Profile Image -->
            <img src="images/profileImages/<?php echo $profileImage; ?>?<?php echo mt_rand(); ?>" alt="Profile Image">
            
            <!-- Display User Name and Username -->
            <h2><?php echo htmlspecialchars($_SESSION['Name']); ?></h2>
            <h4>@<?php echo htmlspecialchars($_SESSION['Username']); ?></h4>
        </div>

        <div class="profile-details">
            <div>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['Email']); ?></p>
            </div>
            <div>
                <p><strong>Mobile:</strong> <?php echo htmlspecialchars($_SESSION['Mobile']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($_SESSION['Addr']); ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <a href="profileEdit.php" class="btn btn-primary btn-custom btn-primary-custom">Edit Profile</a>
            </div>
            <div class="col-md-4">
                <a href="uploadProduct.php" class="btn btn-primary btn-custom btn-primary-custom">Upload Product</a>
            </div>
            <div class="col-md-4">
                <a href="Login/logout.php" class="btn btn-danger btn-custom btn-danger-custom">Log Out</a>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
