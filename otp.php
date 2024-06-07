<?php
session_start();

$enteredOtp = $_POST['otp_inp'];

$server = "localhost";
$user = "root";
$password = "";
$db = "project1";

$con = mysqli_connect($server, $user, $password, $db, 3307);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_SESSION['email'];

$sql_select_otp = "SELECT otp FROM login WHERE Email = ?";
$stmt_select_otp = $con->prepare($sql_select_otp);
if (!$stmt_select_otp) {
    die("Prepare failed: " . $con->error);
}

$stmt_select_otp->bind_param("s", $email);
$stmt_select_otp->execute();
$stmt_select_otp->bind_result($storedOtp);
$stmt_select_otp->fetch();
$stmt_select_otp->close();

if ($enteredOtp == $storedOtp) {
    $sql_update_verified = "UPDATE login SET verified = ? WHERE Email = ?";
    $stmt_update_verified = $con->prepare($sql_update_verified);
    if (!$stmt_update_verified) {
        die("Prepare failed: " . $con->error);
    }

    $verified = $enteredOtp;
    $stmt_update_verified->bind_param("ss", $verified, $email);
    $stmt_update_verified->execute();
    $stmt_update_verified->close();

    echo "<script>alert('Email verification success. Now Login to Vishnu Foods'); window.location='index.html';</script>";
    exit();
} else {
    echo "<script>alert('Invalid OTP. Please enter the correct OTP'); window.location='verify.html';</script>";
}

$con->close();
?>
