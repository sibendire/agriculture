<?php
session_start();
require 'db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['pid']) && isset($_POST['quantity'])) {
    $pid = $_POST['pid'];
    $quantity = intval($_POST['quantity']);

    // Get the current product info and farmer's email
    $stmt = $conn->prepare("SELECT f.femail, f.fname, fp.pnumber, fp.price 
                            FROM fproduct fp 
                            JOIN farmer f ON fp.fid = f.fid 
                            WHERE fp.pid = ?");
    $stmt->bind_param('i', $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product && $product['pnumber'] >= $quantity) {
        // Decrease the product number
        $newPnumber = $product['pnumber'] - $quantity;
        $stmt = $conn->prepare("UPDATE fproduct SET pnumber = ? WHERE pid = ?");
        $stmt->bind_param('ii', $newPnumber, $pid);
        $stmt->execute();

        // Calculate the total cost
        $totalCost = $product['price'] * $quantity;

        $name = $_POST['name'];
        $city = $_POST['city'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $addr = $_POST['addr'];
        $bid = $_SESSION['id'];

        // Insert transaction details into the database
        $sql = "INSERT INTO transaction (bid, pid, name, city, mobile, email, addr, quantity, totalCost)
                VALUES ('$bid', '$pid', '$name', '$city', '$mobile', '$email', '$addr', '$quantity', '$totalCost')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Send email confirmation to the customer
            sendOrderEmail($email, $name, $pid, $quantity, $totalCost);

            // Send email notification to the farmer
            sendFarmerNotification($product['femail'], $product['fname'], $quantity, $newPnumber, $pid, $name, $mobile,  $addr);
            
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Error in placing order. Please try again.')</script>";
        }
    } else {
        echo "<script>alert('Insufficient product quantity.')</script>";
    }
}

function sendOrderEmail($email, $name, $pid, $quantity, $totalCost) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kephas.muhindo@studmc.kiu.ac.ug';
        $mail->Password = 'tzhp cvaw ufyx hndj ';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('kephas.muhindo@studmc.kiu.ac.ug', 'AgroCulture');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'AgroCulture: Order Confirmation';
        $mail->Body = "Dear $name,<br><br>Just a quick note to say we truly appreciate your choice to shop 
                      with us.<br>
                      It's customers like you who enable us to keep our businesses running .:<br>
                      <strong>Product ID:</strong> $pid<br>
                      <strong>Quantity:</strong> $quantity<br>
                      <strong>Total Cost:</strong> $totalCost<br><br>
                      Shortly we're to email you just keep your eyes into your inbox.<br>
                      Best regards,<br>AgroCulture Team";

        $mail->send();
    } catch (Exception $e) {
        echo "<script>alert('Error while sending email: {$mail->ErrorInfo}')</script>";
    }
}

function sendFarmerNotification($farmerEmail, $farmerName, $quantitySold, $remainingQuantity, $pid, $name, $mobile,  $addr) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kephas.muhindo@studmc.kiu.ac.ug';
        $mail->Password = 'tzhp cvaw ufyx hndj ';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('kephas.muhindo@studmc.kiu.ac.ug', 'AgroCulture');
        $mail->addAddress($farmerEmail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'AgroCulture: Product Ordered';
        $mail->Body = "Dear $farmerName,<br><br>Thank you for being a valuable farmer at AgroCulture.<br>
                       The product you uploaded with ID $pid has been ordered.<br>
                      <strong>Product Quantity Ordered for:</strong> $quantitySold<br>
                      <strong>Remaining Quantity in stock:</strong> $remainingQuantity<br><br>
                      <strong>Ordered by:</strong> $name<br><br>
                     <strong>Phone Number:</strong> $mobile<br><br>
                     <strong>Buyer's location:</strong> $addr<br><br>
                      You are reminded to call or email  the buyer when your to deliver his product on time.<br>
                      Best regards,<br>AgroCulture Team";

        $mail->send();
    } catch (Exception $e) {
        echo "<script>alert('Error while sending email to farmer: {$mail->ErrorInfo}')</script>";
    }
}
?>
