<?php
include("connection/connect.php");
error_reporting(0);
session_start();
?>
<?php
// Retrieve the AJAX request data
$restaurantId = $_POST['restaurantId'];
$rating = $_POST['rating'];

// Save the rating to the database

// Create a connection


// Prepare the SQL statement
$sql = "INSERT INTO ratings (restaurant_id, rating) VALUES ('$restaurantId', '$rating')";

// Execute the SQL statement
if ($db->query($sql) === TRUE) {
    echo "Rating submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}
// Close the database connection
$db->close();
?>
