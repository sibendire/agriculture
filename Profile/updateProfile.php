<?php
session_start();
require '../db.php'; // Include database connection

// Function to sanitize user input
function dataFilter($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the user is logged in and is a farmer
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    $_SESSION['message'] = "User ID not found. Please log in again.";
    header("Location: ../Login/error.php");
    exit();
}

if ($_SESSION['Category'] != 1) {
    $_SESSION['message'] = "Unauthorized access! Only farmers can update their profiles.";
    header("Location: ../Login/error.php");
    exit();
}

// Handle form submission for profile update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = dataFilter($_POST['name']);
    $mobile = dataFilter($_POST['mobile']);
    $user = dataFilter($_POST['uname']);
    $email = dataFilter($_POST['email']);
    $addr = dataFilter($_POST['addr']);

    // Update the session variables with the new data
    $_SESSION['Name'] = $name;
    $_SESSION['Mobile'] = $mobile;
    $_SESSION['Username'] = $user;
    $_SESSION['Email'] = $email;
    $_SESSION['Addr'] = $addr;

    // Use prepared statement to prevent SQL injection
    $fid = $_SESSION['id']; // Use session ID for the logged-in farmer
    $stmt = $conn->prepare("UPDATE farmer SET fname=?, fusername=?, fmobile=?, femail=?, faddress=? WHERE fid=?");

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind the parameters to the SQL query
    $stmt->bind_param("sssssi", $name, $user, $mobile, $email, $addr, $fid);

    // Execute the query
    if ($stmt->execute()) {
        $_SESSION['message'] = "Profile updated successfully!";
        header("Location: ../profileView.php"); // Redirect to the profile view page after successful update
        exit();
    } else {
        $_SESSION['message'] = "There was an error updating your profile. Please try again!";
        header("Location: ../Login/error.php"); // Redirect to error page if the update fails
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
