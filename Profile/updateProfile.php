<?php
session_start();
require '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = dataFilter($_POST['name']);
    $mobile = dataFilter($_POST['mobile']);
    $user = dataFilter($_POST['uname']);
    $email = dataFilter($_POST['email']);
    // Assuming there's no 'post' field based on your table structure

    // Setting session variables
    $_SESSION['femail'] = $email;
    $_SESSION['fname'] = $name;
    $_SESSION['fusername'] = $user;
    $_SESSION['fmobile'] = $mobile;

    if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
        $_SESSION['message'] = "User ID not found. Please log in again.";
        header("Location: ../Login/error.php");
        exit(); // Terminate script execution after redirection
    } else {
        $fid = $_SESSION['fid'];

        // Using prepared statements for security
        $stmt = $conn->prepare("UPDATE farmer SET fname=?, fusername=?, fmobile=?, femail=? WHERE fid=?");

        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("ssssi", $name, $user, $mobile, $email, $fid);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Profile Updated successfully !!!";
            header("Location: ../profileView.php");
            exit();
        } else {
            $_SESSION['message'] = "There was an error in updating your profile! Please Try again!";
            header("Location: ../Login/error.php");
            exit();
        }

        $stmt->close();
    }

    $conn->close();
}

function dataFilter($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
9

