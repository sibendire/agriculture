<?php
session_start();
require '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = dataFilter($_POST['name']);
    $mobile = dataFilter($_POST['mobile']);
    $user = dataFilter($_POST['uname']);
    $email = dataFilter($_POST['email']);
    $pass = password_hash(dataFilter($_POST['pass']), PASSWORD_BCRYPT);
    $hash = md5(rand(0, 1000));
    $category = dataFilter($_POST['category']);
    $addr = dataFilter($_POST['addr']);
    
    $_SESSION['Email'] = $email;
    $_SESSION['Name'] = $name;
    $_SESSION['Password'] = $pass;
    $_SESSION['Username'] = $user;
    $_SESSION['Mobile'] = $mobile;
    $_SESSION['Category'] = $category;
    $_SESSION['Hash'] = $hash;
    $_SESSION['Addr'] = $addr;
    $_SESSION['Rating'] = 0;

    if (strlen($mobile) != 10) {
        $_SESSION['message'] = "Invalid Mobile Number!";
        header("location: error.php");
        exit();
    }

    if ($category == 1) {
        $sql = "SELECT * FROM farmer WHERE femail='$email'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            $_SESSION['message'] = "User with this email already exists!";
            header("location: error.php");
            exit();
        }

        $sql = "INSERT INTO farmer (fname, fusername, fpassword, fhash, fmobile, femail, faddress) 
                VALUES ('$name','$user','$pass','$hash','$mobile','$email','$addr')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['Active'] = 0;
            $_SESSION['logged_in'] = true;

            $result = mysqli_query($conn, "SELECT * FROM farmer WHERE fusername='$user'");
            $User = $result->fetch_assoc();
            $_SESSION['id'] = $User['fid'];

            if (isset($_FILES['picName'])) {
                $pic = $_FILES['picName'];
                $picName = $pic['name'];
                $picTmpName = $pic['tmp_name'];
                $picSize = $pic['size'];
                $picError = $pic['error'];

                echo '<pre>';
                print_r($pic);
                echo '</pre>';

                if ($picError === UPLOAD_ERR_NO_FILE) {
                    $_SESSION['message'] = "No file was uploaded!";
                } elseif ($picError !== UPLOAD_ERR_OK) {
                    $_SESSION['message'] = "Error during file upload! Error code: $picError";
                } else {
                    $picExt = strtolower(pathinfo($picName, PATHINFO_EXTENSION));
                    $allowed = array('jpg', 'jpeg', 'png');
                    
                    if (in_array($picExt, $allowed)) {
                        if ($picSize < 5000000) {
                            $picNameNew = "profile_" . $_SESSION['id'] . "." . $picExt;
                            $picDestination = "../images/profileImages/" . $picNameNew;

                            if (move_uploaded_file($picTmpName, $picDestination)) {
                                $sql = "UPDATE farmer SET picStatus=1, fpicname='$picNameNew', picExt='$picExt' WHERE fid=" . $_SESSION['id'];
                                if (mysqli_query($conn, $sql)) {
                                    $_SESSION['message'] = "Profile image uploaded and saved successfully!";
                                } else {
                                    $_SESSION['message'] = "Failed to update image information in the database!";
                                }
                            } else {
                                $_SESSION['message'] = "Failed to move the uploaded file!";
                            }
                        } else {
                            $_SESSION['message'] = "File size exceeds the 5MB limit!";
                        }
                    } else {
                        $_SESSION['message'] = "Invalid file extension! Allowed: jpg, jpeg, png.";
                    }
                }
            } else {
                $_SESSION['message'] = "No file uploaded!";
            }

            $to = $email;
            $subject = "Account Verification (ArtCircle.com)";
            $message_body = "Hello $user,\n\nThank you for signing up! Please click this link to activate your account:\n\nhttp://localhost/AgroBusiness/Login/verify.php?email=$email&hash=$hash";

            // Uncomment to send email
            // mail($to, $subject, $message_body);

            header("location: profile.php");
            exit();
        } else {
            $_SESSION['message'] = "Registration failed!";
            header("location: error.php");
            exit();
        }
    } else {
        // Handle buyer registration if needed
    }
}

function dataFilter($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>