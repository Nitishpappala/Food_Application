<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('c:\Users\nitish\phpmailer\vendor\autoload.php');

$otp = mt_rand(100000, 999999);

$selectedTime = $_POST['timings'];
$orderItems = $_POST['selectedItems'];
$totalAmount = $_POST['totalAmount'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

session_start();
$email = $_SESSION['user'];

$conn = new mysqli($servername, $username, $password, $dbname, 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$mail = new PHPMailer(true);

$mail->IsSMTP(); 
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; 
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465; 
$mail->Username = 'nitishpappala1324@gmail.com'; 
$mail->Password = 'dwtkqilfoqqanvoe';

$mail->setFrom('nitishpappala1324@gmail.com', 'Vishnu Foods');
$mail->addAddress($email);
$mail->Subject = 'Vishnu Foods Order OTP';
$mail->Body = "Your OTP for Vishnu Foods order: " . $orderItems . " is: " . $otp;

if ($mail->send()) {
    $timestamp = date('Y-m-d H:i:s');
    $checkoutTime = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($selectedTime)));

    $sql = "INSERT INTO orders (CustomerEmail, TotalAmount, OrderDate, OrderStatus, OrderItems, CheckOutTiming) 
            VALUES ('$email', '$totalAmount', '$timestamp', '$otp', '$orderItems', '$checkoutTime')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Order Placed. Thank you, visit again'); window.location='Homepage.html';</script>";
    } else {
        echo "<script>alert('Order not placed, try again: " . mysqli_error($conn) . "');</script>";
    }
} else {
    echo "<script>alert('Error sending email. Please try again later.'); window.location='index.html';</script>";
}

$conn->close();
?>
