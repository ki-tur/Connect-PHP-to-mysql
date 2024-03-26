<?php
// Connect to MySQL
$mysqli = new mysqli( "http://localhost/phpmyadmin/index.php?route=/database/structure&db=assignment_db");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Function to place an order
function placeOrder($itemId,) {
    global $mysqli;

    // Retrieve item price
    $query = "SELECT price FROM menu_items WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $stmt->bind_result($price);
    $stmt->fetch();
    $stmt->close();

    // Calculate total price
    $totalPrice = $price ;

    // Insert order into database
    $query = "INSERT INTO orders (item_id, total_price) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("iid", $itemId, $totalPrice);
    $stmt->execute();
    $stmt->close();
}
?>
