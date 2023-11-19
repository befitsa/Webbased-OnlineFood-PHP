<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

$menu_id = $_GET['menu_del'];

if ($menu_id) {
    // Retrieve the image file name for the specific menu ID
    $query = mysqli_query($db, "SELECT img FROM dishes WHERE d_id = '$menu_id'");
    if ($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $image_filename = $row['img'];

        // Delete the image file from the "Res_img/dishes" folder
        $image_path = "Res_img/dishes/" . $image_filename;
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    mysqli_query($db, "DELETE FROM dishes WHERE d_id = '$menu_id'");

    // Check if the deletion was successful
    if (mysqli_affected_rows($db) > 0) {
        // Success message
        $success_message = "Menu item successfully deleted.";
        echo "<script>alert('$success_message'); window.location.replace('all_menu.php');</script>";
        exit();
    } else {
        // Error message
        $error_message = "Error deleting the menu item.";
        echo "<script>alert('$error_message'); window.location.replace('all_menu.php');</script>";
        exit();
    }
} else {
    // Invalid request
    echo "<script>alert('Invalid request.'); window.location.replace('all_menu.php');</script>";
    exit();
}
?>
