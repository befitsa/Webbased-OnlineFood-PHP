<?php
include("connection/connect.php");

if (isset($_FILES['receipt']) && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $file_name = $_FILES['receipt']['name'];
    $file_tmp = $_FILES['receipt']['tmp_name'];

    // Specify the desired directory to store the uploaded receipt
    $upload_dir = "receipts/";

    // Generate a unique file name to avoid overwriting existing files
    $unique_file_name = time() . '_' . $file_name;

    // Move the uploaded file to the desired directory with the unique file name
    if (move_uploaded_file($file_tmp, $upload_dir . $unique_file_name)) {
        // Update the corresponding order record in the database with the receipt file name
        $SQL = "UPDATE users_orders SET receipt = '$unique_file_name' WHERE o_id = '$order_id'";
        mysqli_query($db, $SQL);

        // Success message
        $success_message = "Receipt successfully uploaded.";
        echo $success_message;
    } else {
        $error_message = "Error uploading the receipt.";
        echo $error_message;
    }
} else {
    echo "Error: Invalid request.";
}
?>
