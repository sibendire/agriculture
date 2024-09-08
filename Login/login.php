<?php
session_start();
require '../db.php';

function dataFilter($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = dataFilter($_POST['uname']);
    $password = $_POST['pass'];
    $category = isset($_POST['category']) ? $_POST['category'] : 1; // Default category is 1 (Farmer)

    if ($category == 1) {
        // Farmer login
        $sql = "SELECT * FROM farmer WHERE fusername=?";
    } else {
        // Buyer login
        $sql = "SELECT * FROM buyer WHERE busername=?";
    }

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $User = $result->fetch_assoc();

            if (($category == 1 && password_verify($password, $User['fpassword'])) || 
                ($category == 0 && password_verify($password, $User['bpassword']))) {

                if ($category == 1) {
                    // Farmer session variables
                    $_SESSION['id'] = $User['fid'];
                    $_SESSION['Hash'] = $User['fhash'];
                    $_SESSION['Password'] = $User['fpassword'];
                    $_SESSION['Email'] = $User['femail']; // Store farmer's email
                    $_SESSION['Name'] = $User['fname'];
                    $_SESSION['Username'] = $User['fusername'];
                    $_SESSION['Mobile'] = $User['fmobile'];
                    $_SESSION['Addr'] = $User['faddress'];
                    $_SESSION['Active'] = $User['factive'];
                    $_SESSION['picStatus'] = $User['picStatus'];
                    $_SESSION['picExt'] = $User['picExt'];
                    $_SESSION['logged_in'] = true;
                    $_SESSION['Category'] = 1;
                    $_SESSION['Rating'] = $User['frating'];
                } else {
                    // Buyer session variables
                    $_SESSION['id'] = $User['bid'];
                    $_SESSION['Hash'] = $User['bhash'];
                    $_SESSION['Password'] = $User['bpassword'];
                    $_SESSION['Email'] = $User['bemail']; // Store buyer's email
                    $_SESSION['Name'] = $User['bname'];
                    $_SESSION['Username'] = $User['busername'];
                    $_SESSION['Mobile'] = $User['bmobile'];
                    $_SESSION['Addr'] = $User['baddress'];
                    $_SESSION['Active'] = $User['bactive'];
                    $_SESSION['logged_in'] = true;
                    $_SESSION['Category'] = 0;
                }

                if ($_SESSION['picStatus'] == 0) {
                    $_SESSION['picId'] = 0;
                    $_SESSION['picName'] = "profile0.png";
                } else {
                    $_SESSION['picId'] = $_SESSION['id'];
                    $_SESSION['picName'] = "profile" . $_SESSION['picId'] . "." . $_SESSION['picExt'];
                }

                header("location: profile.php");
                exit();
            } else {
                $_SESSION['message'] = "Invalid User Credentials!";
                header("location: error.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Invalid User Credentials!";
            header("location: error.php");
            exit();
        }
        
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
<div class="container">
    <h3>Login</h3>
    <form method="post" action="login.php">
        <div class="row uniform 50%">
            <div class="7u$">
                <input type="text" name="uname" id="uname" value="" placeholder="UserName" style="width:80%" required/>
            </div>
            <div class="7u$">
                <input type="password" name="pass" id="pass" value="" placeholder="Password" style="width:80%" required/>
            </div>
        </div>
        <div class="row uniform">
            <p><b>Category :</b></p>
            <div class="3u 12u$(small)"> 
                <select id="category" name="category">
                    <option value="1">Farmer</option>
                    <!-- <option value="0">Buyer</option> -->
                </select>	
            </div>
        </div>
        <center>
            <div class="row uniform">
                <div class="7u 12u$(small)">
                    <input type="submit" value="Login" />
                </div>
            </div>
        </center>
    </form>
</div>

</body>
</html>
