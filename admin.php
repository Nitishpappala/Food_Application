<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Vishnu Food</title>
        <link rel="stylesheet" href="Home.css">
        <style>
        nav ul li :visited{
            color: blue;
        }
        nav ul li :hover{
            color: white;
        }
        .ordersadmin {
            display: block;
            justify-content: center;
            text-align: center;
            margin-left: 200px;
            margin-top: 30px;
            margin-right: 200px;
            font-size: 1.2rem;
            animation: fadeIn 3s ease-in-out;
        }
        .ordersadmin div {
            border: 2px solid #333;
            border-radius: 2%;
            margin-bottom: 10px;
            text-align: left;
            padding-left: 80px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
        }
        .ordersadmin button {
            background-color: #feac32;
            font-size: 20px;
            margin-bottom: 40px;
            border-radius: 6px;
            box-shadow: 0 0 15px rgba(254, 172, 50, 1);
        }
        @keyframes fadeIn {
            from {
              opacity: 0;
            }
            to {
              opacity: 1;
            }
        }
        </style>
    </head>
    <body>
    <header>
        <div class="container">
            <h1 class="logo">Vishnu Food</h1>
            <!--This is the nav bar-->
            <nav>
                <ul class="nav-list" id="index">
                    <div class="menu-icon">&#9776;</div>
                    <li><a href="#index">Home</a></li>
                    <li><a href="adminorders.php">Orders</a></li>
                    <li><a href="index.html">Log Out</a></li>
                </ul>
            </nav>
        </div>
        <div id="navbar">
          <a href="#index">Home</a>
          <a href="adminorders.php">Orders</a>
          <a href="index.html">Log Out</a>

        </div>
    </header>

        <div class="ordersadmin">
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "project1";
            
                $conn = new mysqli($servername, $username, $password, $dbname, 3307);
            
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
            
                $sql = "SELECT * FROM orders WHERE OrderStatus > 1 ORDER BY CheckOutTiming";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div>" . "Order Id: " . $row['OrderId'] . "<br>". "Email: " . $row['CustomerEmail']. "<br>". "Items Ordered: " . $row['OrderItems']. "<br>". "Tota Amount: " . $row['TotalAmount']. "<br>". "Order Date: " . $row['OrderDate']. "<br>". "Order Status: " . $row['OrderStatus']. "<br>". "CheckOut Timing: " . $row['CheckOutTiming'] . "</div>";
                        // echo "<form method='post' action='update_status.php'><input type='hidden' name='orderId' value='" . $row['OrderId'] . "'><button type='submit'>Completed</button></form>";
                        echo "<form method='post' action='update_status.php'><input type='hidden' name='orderId' value='" . $row['OrderId'] . "'><button type='button' onclick='confirmUpdate(" . $row['OrderId'] . ")'>Completed</button></form>";
                    }
                } else {
                    echo "No orders found.";
                }
            
                $conn->close();
            ?>
        </div>
    
    <footer id="footer">
      <p>&copy; VMD&NP</p>
      <h2>Website By: VMD&NP</h2>
      <p>Contact us:</p>
      <p>nitishpappala1324@gmail.com</p>
      <p>Phone:63002 76690 </p>
    </footer>
    <script>
        function confirmUpdate(orderId) {
            var confirmation = confirm("Are you sure you want to mark this order as completed?");
            
            if (confirmation) {
                var form = document.querySelector("form[action='update_status.php'][method='post']");
                form.querySelector("input[name='orderId']").value = orderId;
                form.submit();
            }
        }
        window.onscroll = function() {scrollFunction()};
        
        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("navbar").style.top = "0";
            } else {
            document.getElementById("navbar").style.top = "-50px";
            }
        }
    </script>
    </body>
</html>