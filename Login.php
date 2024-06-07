<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['LoginEmail'];
    $password = $_POST['LoginPassword'];

    $servername = 'localhost';
    $username = 'root';
    $password_db = '';
    $dbname = 'project1';

    $conn = new mysqli($servername, $username, $password_db, $dbname, 3307);
    if($email == "admin@bvrit.ac.in" && $password == "admin@123") {
        header("Location: admin.php");
    }else {
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }
    
        $sql = "SELECT Email, Password, otp, verified FROM login WHERE Email=?";
        $stmt = $conn->prepare($sql);
    
        if (!$stmt) {
            die('Error preparing statement: ' . $conn->error);
        }
    
        $stmt->bind_param('s', $email);
    
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $dbPassword = $row['Password'];
            $otp = $row['otp'];
            $verified = $row['verified'];
    
            if ($otp > 1 && $verified > 1 && password_verify($password, $dbPassword)) {
                $_SESSION["user"] = $email;
                header("Location: Homepage.html");
                exit();
            } else {
                echo "<script>alert('Invalid credentials or account not verified.'); window.location='index.html';</script>";
            }
        } else {
            echo "<script>alert('Account does not exist.'); window.location='index.html';</script>";
        }
    
        $stmt->close();
        $conn->close();
    }
}
?>
