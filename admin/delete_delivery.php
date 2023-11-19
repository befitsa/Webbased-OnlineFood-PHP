<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if(empty($_SESSION["adm_id"]))
{
    header('location:index.php');
}
else
{
?>

<?php
// Check if the ID parameter is provided in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the delivery person from the database
    $deleteQuery = "DELETE FROM delivery WHERE id='$id'";
    $result = mysqli_query($db, $deleteQuery);

    if ($result) {
        // Deletion successful
        echo '<script>alert("Delivery person deleted successfully!");</script>';
    } else {
        // Error occurred while deleting the delivery person
        echo '<script>alert("Error: ' . mysqli_error($db) . '");</script>';
    }
}

// Redirect back to the main page
header("Location: delivery_fetch.php");
exit();
?>

<?php
}
?>
