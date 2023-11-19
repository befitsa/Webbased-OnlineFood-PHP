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
<!DOCTYPE html>
<html>
<head>
  <title>Delivery Person Registration</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <link href="css/style.css" rel="stylesheet">
  <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="css/helper.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delivery'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $password = md5($_POST["password"]);

    // Validate the form inputs as needed
    
    // Insert the data into the "delivery" table
    $insertQuery = "INSERT INTO delivery (name, email,password, phone, address) VALUES ('$name', '$email', '$password','$phone', '$address')";
    $result = mysqli_query($db, $insertQuery);

    if ($result) {
        // Registration successful
        echo '<script>alert("Delivery person registered successfully!");</script>';
    } else {
        // Error occurred while inserting into the table
        echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
    }
}

?>



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
          <h2>Delivery Person Registration Form</h2>
          
          <form action="" method="POST">
            <div class="form-group">
              <label for="name">Full Name:</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            
            <div class="form-group">
              <label for="phone">Phone Number:</label>
              <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
              <label for="phone">Password:</label>
              <input type="tel" class="form-control" id="password" name="password" required>
            </div>
            
            <div class="form-group">
              <label for="address">Address:</label>
              <textarea class="form-control" id="address" name="address" required></textarea>
            </div>
            
            <button type="submit" name='delivery' class="btn btn-primary">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <?php include("footer.php"); ?>
</div>
<script src="js/lib/jquery/jquery.min.js"></script>
<script src="js/lib/bootstrap/js/popper.min.js"></script>
<script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/sidebarmenu.js"></script>
<script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="js/custom.min.js"></script>
</body>
</html>
<?php
}
?>
