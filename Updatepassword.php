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
        .cont {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: auto;
        }
        .form {
            background-color: #fff;
            padding: 60px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .fil {
            margin-bottom: 15px;
            font-size: 20px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        #Updatebtn {
            width: 100%;
            padding: 10px;
            background-color: #1a75ff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }
        #head{
            background-color: #1a75ff;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 8px;
            margin-bottom: 10px;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="cont">
        <div class="form">
            <div class="fi">
                <h2 id="head">Password Update</h2>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="fil">
                    <input type="text" id="Updateotp" name="Updateotp" placeholder="OTP">
                </div>
                <div class="fil">
                    <input type="password" id="Updatepass" name="Updatepass" placeholder="Password">
                </div>
                <div class="fil">
                    <input type="password" id="Updateconfirm" name="Updateconfirm" placeholder="Confirm Password">
                </div>
                <div class="button">
                    <button onclick="return check();" id="Updatebtn" name="Updatebtn">Update</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function check(){
            var pass = document.getElementById('Updatepass').value;
            var otp = document.getElementById('Updateotp').value;
            var conf = document.getElementById('Updateconfirm').value;

            if(otp.trim() === ""){
                alert("otp cannot be null");
                return false;
            }

            if (pass.trim().length < 8 || !/[A-Z]/.test(pass) || !/[!@#$%^&*(),.?":{}|<>]/.test(pass)) {
                alert("Password must be at least 8 characters long, contain a capital letter, and include a special symbol.");
                return false;
            }

            if (conf.trim() === "" || conf !== pass) {
                alert("Password and confirm password should match.");
                return false;
            }
            return true;
        }
    </script>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = 'localhost';
    $username = 'root';
    $password_db = '';
    $dbname = 'project1';

    $conn = new mysqli($servername, $username, $password_db, $dbname, 3307);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $email = $_SESSION['email'];

    $sql = "SELECT otp FROM login WHERE Email='$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $otpFromDB = $row['otp'];
        
        $enteredOTP = $_POST['Updateotp'];
        
        if ($otpFromDB == $enteredOTP) {
            $password = $_POST['Updatepass'];

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $updateSql = "UPDATE login SET verified='$enteredOTP', Password='$hashedPassword' WHERE Email='$email'";
            if ($conn->query($updateSql) === TRUE) {
                echo "<script>alert('Password updated successfully.'); window.location='index.html'</script>";
            } else {
                echo "<script>alert('Error updating password: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Incorrect OTP.');</script>";
        }
    } else {
        echo "<script>alert('Email not found in the database.');</script>";
    }

    $conn->close();
}
?>

</body>
</html>