<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

// Retrieve the information including the receipt file name
$sql = "SELECT * FROM users_orders WHERE o_id = '".$_GET['order_del']."'";
$query = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($query);
$receiptFileName = $row['receipt'];

// Delete the record from the database
mysqli_query($db, "DELETE FROM users_orders WHERE o_id = '".$_GET['order_del']."'");

// Delete the image file from the folder
$receiptImagePath = '../receipts/' . $receiptFileName;
if (!empty($receiptFileName) && is_file($receiptImagePath)) {
    unlink($receiptImagePath);
}

header("location:all_orders.php");  
?>
