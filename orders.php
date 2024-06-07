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
      .displayOrders {
        margin-left: 400px;
        margin-right: 400px;
        text-align: left;
        justify-content: center;
        margin-top: 20px;
        margin-bottom: 20px;
        font-size: 20px
      }
      #heading {
        margin-top: 20px;
        margin-bottom: 30px;
        text-align: center;
      }
      .order {
        border: 2px solid #333;
        margin-top: 25px;
        padding-left: 60px;
        border-radius: 12px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
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
                    <li><a href="Homepage.html">Home</a></li>
                    <li><a href="#footer">About</a></li>
                    <li><a href="orders.php">Orders</a></li>
                    <li><a href="index.html">Log Out</a></li>
                </ul>
            </nav>
        </div>
        <div id="navbar">
          <a href="#index">Home</a>
          <a href="#footer">About</a>
          <a href="orders.php">Orders</a>
          <a href="index.html">Log Out</a>

        </div>
      </header>
      <!--This is search section-->
      <section class="nitish">
          <div class="nit-sec">
            <h2>Welcome To Vishnu Foods</h2>
            <p>check your order history here</p>
            
          </div>
      </section>

      <h2 id="heading">Your Order History</h2>

      <div class="displayOrders">
        <?php
        session_start();

        if(isset($_SESSION['user'])) {
            $email = $_SESSION['user'];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "project1";

            $conn = new mysqli($servername, $username, $password, $dbname, 3307);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM orders WHERE CustomerEmail = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  echo '<div class="order">';
                  echo "Order ID: " . $row["OrderId"]. "<br>" ."Total Amount: " . $row["TotalAmount"]."<br>". "Order Date: " . $row["OrderDate"]. "<br>" . "Order Items: " . $row["OrderItems"] . "<br><br>";
                  echo '</div>';                }
            } else {
                echo "<script>alert('No Orders are found for this email'); window.location='Homepage.html';</script>";
            }

            $conn->close();
        } else {
            echo "<script>alert('Error Login again'); window.location='Homepage.html';</script>";
        }
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
        // When the user scrolls down 20px from the top of the document, slide down the navbar
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