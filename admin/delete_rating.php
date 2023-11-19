<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

// Check if the ID parameter is present in the URL
if (isset($_GET['id'])) {
    $ratingId = $_GET['id'];

    // Delete the rating from the database
    $deleteQuery = "DELETE FROM rating WHERE id = $ratingId";
    $result = mysqli_query($db, $deleteQuery);

    if ($result) {
        // Rating deleted successfully
        header("Location: manage_rating.php"); // Redirect to the ratings page
        exit();
    } else {
        // Failed to delete rating
        echo "Error deleting rating: " . mysqli_error($db);
    }
} else {
    // ID parameter is not present in the URL
    echo "Invalid request";
}
?>
