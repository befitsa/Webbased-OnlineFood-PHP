<?php
include("connection/connect.php"); // Include the database connection

// Check if the form is submitted
if (isset($_POST['submit']) && isset($_POST['order_id']) && isset($_POST['existing_receipt'])) {
    $order_id = $_POST['order_id'];
    $existing_receipt = $_POST['existing_receipt'];

    // Remove the existing receipt file
    $receipt_path = 'receipts/' . $existing_receipt;
    if (file_exists($receipt_path)) {
        unlink($receipt_path);
    }

    // Upload the new receipt file
    $new_receipt = $_FILES['receipt'];
    $new_receipt_name = $new_receipt['name'];
    $new_receipt_temp = $new_receipt['tmp_name'];
    $new_receipt_ext = strtolower(pathinfo($new_receipt_name, PATHINFO_EXTENSION));
    $new_receipt_unique_name = uniqid() . '.' . $new_receipt_ext;
    $new_receipt_path = 'receipts/' . $new_receipt_unique_name;

    if (move_uploaded_file($new_receipt_temp, $new_receipt_path)) {
        // Update the receipt in the database
        mysqli_query($db, "UPDATE users_orders SET receipt = '$new_receipt_unique_name' WHERE o_id = '$order_id'");

        // Display JavaScript alert
        echo "<script>alert('Receipt has been changed successfully.');</script>";
    } else {
        // Display JavaScript alert
        echo "<script>alert('Failed to upload the new receipt.');</script>";
    }
}

// Redirect back to your_orders.php
echo "<script>window.location.replace('your_orders.php');</script>";
exit();
?>
