<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "maharashtra"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else {
    echo "Connected successfully to the database.<br>";
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Form submitted successfully!";
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $adults = (int)$_POST['adults'];
    $children = (int)$_POST['children'];
    $date = $_POST['date'];
    $totalCost = ($adults * 4500) + ($children * 2000); // Calculate total cost
    $status = "Pending"; // Default status

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO bookings (name, phone, email, adults, children, date, totalCost, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiisss", $name, $phone, $email, $adults, $children, $date, $totalCost, $status);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Booking successful!";
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
