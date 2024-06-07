<?php
// Check if orderId is received
if(isset($_POST['orderId'])) {
    // Retrieve orderId from POST request
    $orderId = $_POST['orderId'];

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project1";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname, 3307);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query to update order status
    $sql = "UPDATE orders SET OrderStatus = 1 WHERE OrderId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderId);

    if ($stmt->execute()) {
        // Order status updated successfully
        echo "Order status updated successfully.";
    } else {
        // Failed to update order status
        echo "Error updating order status: " . $conn->error;
    }

    // Close database connection
    $conn->close();
} else {
    // orderId is not received
    echo "Order ID not provided.";
}
?>
