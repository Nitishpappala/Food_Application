<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vishnu Foods</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: -webkit-linear-gradient(left, #003366,#004080,#0059b3
, #0073e6);
        }
        .wrap {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: auto;
        }
        #head{
            background-color: #1a75ff;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0.5px;
            margin-bottom: 10px;
            color: #fff;
        }
        .form {
            background-color: #fff;
            padding: 60px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .fil {
            margin-bottom: 15px;
        }
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #1a75ff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #004080;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="form">
            <div id="head" class="fill">
                <h2 id="he">Forgot Password</h2>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="fil">
                    <input type="email" id="Forgetmail" name="Forgetmail" placeholder="Email">
                </div>
                <div class="fil">
                    <button type="submit" id="Forgrtbtn" name="Forgetbtn">Continue</button>
                </div>
            </form>
        </div>
    </div>

    <?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require('c:\Users\nitish\phpmailer\vendor\autoload.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = 'localhost';
    $username = 'root';
    $password_db = '';
    $dbname = 'project1';

    $conn = new mysqli($servername, $username, $password_db, $dbname, 3307);

    if (mysqli_connect_errno()) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    $email = mysqli_real_escape_string($conn, $_POST['Forgetmail']);

    $sql = "SELECT Email FROM login WHERE Email='$email'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $otp = mt_rand(100000, 999999);

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
        $mail->Subject = 'Vishnu Foods OTP Verification';
        $mail->Body = "Your OTP for Vishnu Foods account creation is: $otp";

        if ($mail->send()) {
            $updateSql = "UPDATE login SET otp='$otp' WHERE Email='$email'";
            if (mysqli_query($conn, $updateSql)) {
                $_SESSION['email'] = $email;
                echo "<script>alert('Check your mail for OTP for Password update.'); window.location='Updatepassword.php';</script>";
            } else {
                echo "<script>alert('Error updating OTP');</script>";
            }
        } else {
            echo "<script>alert('Error sending email');</script>";
        }
    } else {
        echo "<script>alert('Email does not exist in the database'); window.location='index.html'</script>";
    }

    mysqli_close($conn);
}
?>

</body>
</html>
