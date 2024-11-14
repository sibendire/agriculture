<?php
session_start();
require 'db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productType = $_POST['type'];
    $productName = dataFilter($_POST['pname']);
    $pnumber = dataFilter($_POST['pnumber']);
    $productInfo = $_POST['pinfo'];
    $productPrice = dataFilter($_POST['price']);
    $fid = $_SESSION['id'];

    // Insert product details into the database
    $sql = "INSERT INTO fproduct (fid, product, pcat, pinfo, price, pnumber)
            VALUES ('$fid', '$productName', '$productType', '$productInfo', '$productPrice', '$pnumber')";

    if (mysqli_query($conn, $sql)) {
        // Handling the product image upload
        $pic = $_FILES['productPic'];
        $picName = $pic['name'];
        $picTmpName = $pic['tmp_name'];
        $picError = $pic['error'];
        $picExt = strtolower(pathinfo($picName, PATHINFO_EXTENSION));
        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($picExt, $allowed)) {
            if ($picError === 0) {
                $picNameNew = $productName . "_" . $fid . "." . $picExt;
                $picDestination = "images/productImages/" . $picNameNew;
                if (move_uploaded_file($picTmpName, $picDestination)) {
                    $sql = "UPDATE fproduct SET picStatus=1, pimage='$picNameNew' WHERE product='$productName'";
                    if (mysqli_query($conn, $sql)) {
                        $_SESSION['message'] = "Product Image Uploaded successfully!";
                    } else {
                        $_SESSION['message'] = "Error updating product image in the database!";
                        header("Location: Login/error.php");
                        exit();
                    }
                } else {
                    $_SESSION['message'] = "Failed to move uploaded file!";
                    header("Location: Login/error.php");
                    exit();
                }
            } else {
                $_SESSION['message'] = "Error during file upload!";
                header("Location: Login/error.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Invalid file extension for product image!";
            header("Location: Login/error.php");
            exit();
        }

        // Send email notification to farmer
        if (isset($_SESSION['Email']) && !empty($_SESSION['Email']) ||isset($_SESSION['Name']) && !empty($_SESSION['Name'])) {
            $email = $_SESSION['Email'];
            $name = $_SESSION['Name'];
            sendProductUploadEmail($email,$name, $pnumber, $productName, $productPrice, $picDestination); 
            
            $_SESSION['message'] = "Unable to retrieve your email. Please contact support.";
            header("Location: Login/error.php");
            exit();
        }

    } else {
        $_SESSION['message'] = "Unable to upload Product!";
        header("Location: Login/error.php");
        exit();
    }
}

function dataFilter($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function sendProductUploadEmail($email,$name, $pnumber, $productName, $productPrice, $picPath) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kephas.muhindo@studmc.kiu.ac.ug';
        $mail->Password = 'tzhp cvaw ufyx hndj ';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('kephas.muhindo@studmc.kiu.ac.ug', 'AgroCulture');
        $mail->addAddress($email,$name);
        

        // Attach the product image
        $mail->addAttachment($picPath);  

        // Embed the image in the email body
        $mail->AddEmbeddedImage($picPath, 'product_image');  

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'AgroCulture: Product Uploaded Successfully';
        $mail->Body = "Dear $name,<br><br>Thank you for uploading your product to AgroPreneur, the premier digital marketplace revolutionizing agribusiness.<br> 
        Here are the details of your product:<br>
        <strong>Product Name:</strong> $productName<br>
        <strong>Number of Products:</strong> $pnumber<br>
        <strong>Product Price Each:</strong> $productPrice<br><br>
        <strong>Image:</strong><br><br>
        <img src='cid:product_image' alt='Product Image'><br><br>
        Best regards,<br>
        AgroCulture Team";

        if ($mail->send()) {
            $_SESSION['message'] = "Product Uploaded and email sent successfully!";
        } else {
            $_SESSION['message'] = "Product uploaded, but email could not be sent.";
            header("Location: Login/error.php");
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Product uploaded, but email could not be sent. Please try again later.";
        header("Location: Login/error.php");
        exit();
    }
    header("Location: index.php");
    exit();
}

?>
