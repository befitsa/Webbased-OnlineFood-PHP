<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

$res_id = $_GET['res_del'];

if ($res_id) {
    // Retrieve the image file name for the specific ID
    $query = mysqli_query($db, "SELECT image FROM restaurant WHERE rs_id = '$res_id'");
    $row = mysqli_fetch_assoc($query);
    $image_file = $row['image'];

    // Delete the image file from the folder
    $image_path = "Res_img/" . $image_file;
    if (file_exists($image_path)) {
        unlink($image_path);
    }

    // Delete the restaurant record from the database
    mysqli_query($db, "DELETE FROM restaurant WHERE rs_id = '$res_id'");

    // Check if the deletion was successful
    if (mysqli_affected_rows($db) > 0) {
        // Success message
        $success_message = "Restaurant successfully deleted.";
        echo "<script>alert('$success_message'); window.location.replace('all_restaurant.php');</script>";
        exit();
    } else {
        // Error message
        $error_message = "Error deleting the restaurant.";
        echo "<script>alert('$error_message'); window.location.replace('all_restaurant.php');</script>";
        exit();
    }
} else {
    // Invalid request
    echo "<script>alert('Invalid request.'); window.location.replace('all_restaurant.php');</script>";
    exit();
}
?>
