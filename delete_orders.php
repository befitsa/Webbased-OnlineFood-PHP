<?php
include("connection/connect.php"); //connection to db
error_reporting(0);
session_start();

$order_id = $_GET['order_del'];

// Check if the order has an associated receipt
$existing_receipt = mysqli_query($db, "SELECT receipt FROM users_orders WHERE o_id = '$order_id'");
$row = mysqli_fetch_assoc($existing_receipt);
$existing_file = $row['receipt'];

// Delete the existing receipt file
if ($existing_file) {
    $upload_dir = "receipts/";
    unlink($upload_dir . $existing_file);
}

// sending query
mysqli_query($db, "DELETE FROM users_orders WHERE o_id = '$order_id'"); 

header("location:your_orders.php"); 
?>
