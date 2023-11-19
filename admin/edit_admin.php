<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

// Check if the admin ID is provided in the URL
if (isset($_GET['id'])) {
  $adminID = $_GET['id'];

  // Fetch admin information from the database based on the ID
  $query = "SELECT * FROM admin WHERE adm_id = '$adminID'";
  $result = mysqli_query($db, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $adminData = mysqli_fetch_assoc($result);
  } else {
    // Admin record not found
    echo "<script>alert('Admin not found.'); window.location.href = 'manage_admins.php';</script>";
    exit();
  }
} else {
  // Admin ID not provided in the URL
  echo "<script>alert('Admin ID not provided.'); window.location.href = 'manage_admins.php';</script>";
  exit();
}

// Update admin information
if (isset($_POST['update'])) {
  $firstName = $_POST['f_name'];
  $lastName = $_POST['l_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $username = $_POST['user_name'];

  // Perform update query
  $updateQuery = "UPDATE admin SET firstName='$firstName', lastName='$lastName', email='$email', phone='$phone', username='$username' WHERE adm_id='$adminID'";
  $updateResult = mysqli_query($db, $updateQuery);

  if ($updateResult) {
    // Admin information updated successfully
    echo "<script>alert('Admin information updated successfully.'); window.location.href = 'manage_admins.php';</script>";
    exit();
  } else {
    // Error occurred while updating admin information
    $error = "Error: " . mysqli_error($db);
    echo "<script>alert('$error'); window.location.href = 'manage_admins.php';</script>";
    exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Admin</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <link href="css/style.css" rel="stylesheet">
  <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="css/helper.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
  <?php include("header.php"); ?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-2">
        <div style="overflow-y: scroll;border-right:2px solid orange;">
          <?php include("sidebar.php"); ?>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="row">
          <div class="col-sm-12">
            <h2>Edit Admin</h2>
            <?php if (isset($error)): ?>
              <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="" method="POST" style="width:300px">
              <div class="form-group">
                <label for="f_name">First Name:</label>
                <input type="text" class="form-control" id="f_name" name="f_name" required value="<?php echo $adminData['firstName']; ?>">
              </div>
              <div class="form-group">
                <label for="l_name">Last Name:</label>
                <input type="text" class="form-control" id="l_name" name="l_name" required value="<?php echo $adminData['lastName']; ?>">
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required value="<?php echo $adminData['email']; ?>">
              </div>
              <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" required value="<?php echo $adminData['phone']; ?>">
              </div>
              <div class="form-group">
                <label for="user_name">Username:</label>
                <input type="text" class="form-control" id="user_name" name="user_name" required value="<?php echo $adminData['username']; ?>">
              </div>

              <button type="submit" name="update" class="btn btn-primary">Update Admin</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include("footer.php"); ?>

  <script src="js/lib/jquery/jquery.min.js"></script>
  <script src="js/lib/bootstrap/js/popper.min.js"></script>
  <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="js/jquery.slimscroll.js"></script>
  <script src="js/sidebarmenu.js"></script>
  <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
  <script src="js/custom.min.js"></script>
</body>
</html>
