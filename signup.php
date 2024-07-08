<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require('c:\Users\nitish\phpmailer\vendor\autoload.php');

$otp = mt_rand(100000, 999999);

$server = "localhost";
$user = "root";
$password = "";
$db = "project1";
$name = $_POST['SignupUserName'];
$email = $_POST['SignupEmail'];
$pass = $_POST['SignupPassword'];
$pass = $_POST['SignupConfirm'];
$timestamp = date('Y-m-d H:i:s');

$passhash = password_hash($pass, PASSWORD_DEFAULT);
$con = mysqli_connect($server,$user,$password,$db,3307);
if(!$con){
    die("connection failed: " . mysqli_connect_error());
}

$mail = new PHPMailer(true);

$mail->IsSMTP(); 
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; 
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465; 
$mail->Username = 'nitishpappala1324@gmail.com'; 
$mail->Password = 'dwtkfoqqanvoe';

$mail->setFrom('nitishpappala1324@gmail.com', 'Vishnu Foods');
$mail->addAddress($email, $name);
$mail->Subject = 'Vishnu Foods OTP Verification';
$mail->Body = "Your OTP for Vishnu Foods account creation is: " . $otp;

if($mail->send()){

    session_start();
    $_SESSION['email'] = $email;

    $sql = "INSERT INTO login(Email,Password,Name,Regdate,otp) VALUES('$email','$passhash','$name','$timestamp','$otp')";
    if(mysqli_query($con, $sql)){
        echo "<script>alert('Signup Successful. Check Email and verify in Login'); window.location='verify.html';</script>";
    } else {
        echo "<script>alert('Error INSERTING into table: " . mysqli_error($con) . "');</script>";
    }
} else {
    echo "<script>alert('Error sending email. Please try again later.'); window.location='index.html';</script>";
}
mysqli_close($con);
?>
