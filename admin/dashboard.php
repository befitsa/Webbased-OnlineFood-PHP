<!DOCTYPE html>
<html lang="en">
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
<head>


<!-- Add the following JavaScript files at the bottom of your HTML, just before the closing </body> tag -->



    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Panel</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
     <link href="css/style.css" rel="stylesheet"> </head>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
      .close {
  color: #000;
  opacity: 1;
  font-size: 24px;
}

    </style>
</head>

<body>
<?php   include("header.php"); ?>

<div class="row">
<div style="overflow-y: scroll;border-right:2px solid orange;" class="col-sm-2" >
  <?php include("sidebar.php"); ?>
</div>

<div class="col-sm-10">
  <div class="row">
    <div class="col-md-2">
      <div class="card ">
        <div class="media">
          <div class="media-body media-text-right">
            <p class="m-b-0" style="color:black">Restaurants</p>
            <h3 class="text-center"><?php $sql="select * from restaurant";
              $result=mysqli_query($db,$sql); 
              $rws=mysqli_num_rows($result);
              echo $rws;?></h3>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-md-2">
      <div class="card ">
        <div class="media">
          <div class="media-body media-text-right">
            <p class="m-b-0" style="color:black">Dishes</p>
            <h3 class="text-center"><?php $sql="select * from dishes";
              $result=mysqli_query($db,$sql); 
              $rws=mysqli_num_rows($result);
              echo $rws;?></h3>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-md-2">
      <div class="card">
        <div class="media">
          <div class="media-body media-text-right">
            <p class="m-b-0" style="color:black">Users</p>
            <h3 class="text-center"><?php $sql="select * from users";
              $result=mysqli_query($db,$sql); 
              $rws=mysqli_num_rows($result);
              echo $rws;?></h3>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-md-2">
      <div class="card ">
        <div class="media">
          <div class="media-body media-text-right">
            <p class="m-b-0" style="color:black">Total Orders</p>
            <h3 class="text-center"><?php $sql="select * from users_orders";
              $result=mysqli_query($db,$sql); 
              $rws=mysqli_num_rows($result);
              echo $rws;?></h3>
          </div>
        </div>
      </div>
    </div>	                   
  </div>     
  
  <div class="row">
    <div class="col-md-2">
      <div class="card ">
        <div class="media">
          <div class="media-body media-text-right">
            <p class="m-b-0" style="color:black">Restaurant Categories</p>
            <h3 class="text-center"><?php $sql="select * from res_category";
              $result=mysqli_query($db,$sql); 
              $rws=mysqli_num_rows($result);
              echo $rws;?></h3>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-md-2">
      <div class="card ">
        <div class="media">
          <div class="media-body media-text-right">
            <p class="m-b-0" style="color:black">Processing Orders</p>
            <h3 class="text-center"><?php $sql="select * from users_orders WHERE status = 'in process' ";
              $result=mysqli_query($db,$sql); 
              $rws=mysqli_num_rows($result);
              echo $rws;?></h3>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-2">
      <div class="card ">
      <div class="media">
  <div class="media-body media-text-right">
    <p class="m-b-0" style="color:black">Delivered Orders</p>
    <h3 class="text-center"><?php $sql="select * from users_orders WHERE status = 'closed' ";
      $result=mysqli_query($db,$sql); 
      $rws=mysqli_num_rows($result);
      echo $rws;?></h3>
  </div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-2">
  <div class="card ">
    <div class="media">
      <div class="media-body media-text-right">
        <p class="m-b-0" style="color:black">Cancelled Orders</p>
        <h3 class="text-center"><?php $sql="select * from users_orders WHERE status = 'rejected' ";
          $result=mysqli_query($db,$sql); 
          $rws=mysqli_num_rows($result);
          echo $rws;?></h3>
      </div>
    </div>
  </div>
</div>

<div class="col-md-2">
  <div class="card">
    <div class="media">
      <div class="media-body media-text-right">
        <p class="m-b-0" style="color:black">Total Earnings</p>
        <h3 class="text-center"><?php 
          $result = mysqli_query($db, 'SELECT SUM(price) AS value_sum FROM users_orders WHERE status = "closed"'); 
          $row = mysqli_fetch_assoc($result); 
          $sum = $row['value_sum'];
          echo $sum;
          ?></h3>
      </div>
  </div>
</div>
</div>
</div>

<div class="container">
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">User Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Your PHP code for fetching and displaying user information -->
          <?php
        // Assuming you have a database connection established

        // Check if the u_id is set in the session
        if (isset($_SESSION["adm_id"])) {
            // Perform a query to fetch the user's information
            $query = "SELECT * FROM admin WHERE adm_id = " . $_SESSION["adm_id"];
            $result = mysqli_query($db, $query);

            // Check if the query was successful and if there is a matching user
            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                $f_name = $user['firstName'];
                $user_name = $user['username'];
                $l_name = $user['lastName'];
                $email =$user['email'];
                $phone =$user['phone'];
                $password =$user['password'];

                // Display the user's information in editable input fields
                echo '<form action="" method="post">
                <div class="form-group">
                <label for="f_name">User Name:</label>
                <input required type="text" class="form-control" id="f_name" name="user_name" value="' . $user_name . '">
              </div>
                        <div class="form-group">
                          <label for="f_name">First Name:</label>
                          <input required type="text" class="form-control" id="f_name" name="f_name" value="' . $f_name . '">
                        </div>
                        <div class="form-group">
                          <label for="l_name">Last Name:</label>
                          <input required type="text" class="form-control" id="l_name" name="l_name" value="' . $l_name . '">
                        </div>
                        <div class="form-group">
                          <label for="email">Email:</label>
                          <input required type="email" class="form-control" id="l_name" name="email" value="' . $email . '">
                        </div>
                        <div class="form-group">
                        <label for="phone">phone:</label>
                        <input required type="tel" class="form-control" id="l_name" name="phone" value="' . $phone . '">
                      </div>
                   
                        <button type="submit" name="profile" class="btn btn-primary col-sm-12" style="border-radius:10px">Update Profile</button>
                      </form>';
            } else {
                // Handle error if the user is not found in the database
                echo 'Error: User not found';
            }
        } else {
            echo 'Error: User ID not set in session';
        }

        // Remember to close the database connection
        ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add this JavaScript code after including the necessary jQuery and Bootstrap files -->
<script>
  // Remove modal backdrop when the modal is closed
  $('#exampleModal').on('hidden.bs.modal', function () {
    $('.modal-backdrop').remove();
  });
</script>


<!--  add new admin -->
<div class="container " >
<div  class="modal fade" id="exampleModa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        
<?php  
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["adm_id"]) && isset($_POST['add'])) {
  // Retrieve the form data
  $f_name = $_POST["f_name"];
  $l_name = $_POST["l_name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $password =md5($_POST["password"]);
  $user_name = $_POST["user_name"];

  // Insert the user's profile into the database
  $query = "INSERT INTO admin (firstName, lastName, phone,username, password,email) VALUES ( '$f_name', '$l_name', '$phone','$user_name', '$password','$email')";

  if (mysqli_query($db, $query)) {
      // Profile updated successfully
      echo "<script>alert('Admin Added successfully.')</script>";
  } else {
      // Error updating profile
      echo "<script>alert('Error Adding admin: " . mysqli_error($db) . "')</script>";
  }

  // Remember to close the database connection
}
?>
        <?php
        // Assuming you have a database connection established

        // Check if the u_id is set in the session
       

                // Display the user's information in editable input fields
                echo '<form action="" method="POST">
                <div class="form-group">
                <label for="f_name">User Name:</label>
                <input required type="text" class="form-control" id="f_name" name="user_name" >
              </div>
                        <div class="form-group">
                          <label for="f_name">First Name:</label>
                          <input required type="text" class="form-control" id="f_name" name="f_name" >
                        </div>
                        <div class="form-group">
                          <label for="l_name">Last Name:</label>
                          <input required type="text" class="form-control" id="l_name" name="l_name" >
                        </div>
                        <div class="form-group">
                          <label for="email">Email:</label>
                          <input required type="email" class="form-control" id="l_name" name="email" >
                        </div>
                        <div class="form-group">
                        <label for="phone">phone:</label>
                        <input required type="tel" class="form-control" id="l_name" name="phone" >
                      </div>
                    <div class="form-group">
                      <label for="password">password:</label>
                      <input required type="text" class="form-control" id="l_name" name="password" >
                    </div>
                        <button name="add" type="submit" class="btn btn-primary col-sm-12" style="border-radius:10px">Add Admin</button>
                      </form>';
           
        // Remember to close the database connection
        ?>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  // Remove modal backdrop when the modal is closed
  $('#exampleModa').on('hidden.bs.modal', function () {
    $('.modal-backdrop').remove();
  });
</script>
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
