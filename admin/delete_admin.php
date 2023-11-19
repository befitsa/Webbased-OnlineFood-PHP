<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

// Check if the admin ID is provided in the URL
if (isset($_GET['id'])) {
  $adminID = $_GET['id'];

  // Delete the admin record from the database
  $deleteQuery = "DELETE FROM admin WHERE adm_id='$adminID'";
  $deleteResult = mysqli_query($db, $deleteQuery);

  if ($deleteResult) {
    // Admin record deleted successfully
    echo "<script>alert('Admin deleted successfully.'); window.location.href = 'manage_admins.php';</script>";
    exit();
  } else {
    // Error occurred while deleting admin record
    $error = "Error: " . mysqli_error($db);
    echo "<script>alert('$error'); window.location.href = 'manage_admins.php';</script>";
    exit();
  }
} else {
  // Admin ID not provided in the URL
  echo "<script>alert('Admin ID not provided.'); window.location.href = 'manage_admins.php';</script>";
  exit();
}
?>
