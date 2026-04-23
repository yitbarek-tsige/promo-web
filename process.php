<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data
    $name    = $_POST['firstName'];
    $phone   = $_POST['phone'];
    $city    = $_POST['city'];
    $address = $_POST['address'];
    $package = $_POST['package'];

    // 1. Save to Database
    $stmt = $conn->prepare("INSERT INTO orders (first_name, phone, city, address, package) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $phone, $city, $address, $package);
    $stmt->execute();

    // 3. Just send a simple text back to JavaScript
    echo "Success"; 
}
?>