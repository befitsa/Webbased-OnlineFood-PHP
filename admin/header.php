<?php
// Assuming you have a database connection established

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["adm_id"]) && isset($_POST['profile'])) {
    // Retrieve the form data
    $f_name = $_POST["f_name"];
    $l_name = $_POST["l_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $user_name = $_POST["user_name"];

    // Update the user's profile in the database
    $query = "UPDATE admin SET username='$user_name', firstName = '$f_name', lastName = '$l_name', email = '$email', phone = '$phone' WHERE adm_id = " . $_SESSION["adm_id"];

    if (mysqli_query($db, $query)) {
        // Profile updated successfully
        echo "<script>alert('Profile updated successfully..')</script>";
   

    } else {
        // Error updating profile
        echo "<script>alert('Error updating profile:')</script>".mysqli_error($db);
        
    }

    // Remember to close the database connection
 
}
?>


<div style="background-color:#009999;">
  <nav class="navbar navbar-expand-lg navbar-light ">
    <a class="navbar-brand" href="dashboard.php" style="font-size:14px; color:white;">Mesob Food ordering and Delivery system</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span style="color:white" class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav" style="font-size:13px;">
        <li class="nav-item active">
          <a class="nav-link" href="dashboard.php" style="color:white;">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php" style="color:white;">Welcome to Admin Dashboard</a>
        </li>
    <li class="nav-item"> <button style="font-size:14px; background-color:#009999;color:white" type="button" class="btn " data-toggle="modal" data-target="#exampleModal">
                                    profile
                                  </button></li>   
                                  <li class="nav-item"> <button style="font-size:14px; background-color:#009999;color:white" type="button" class="btn " data-toggle="modal" data-target="#exampleModa">
                                    add new Admin
                                  </button></li>                              
        <li class="nav-item">
          <a class="nav-link" href="logout.php" style="color:white;">logout</a>
        </li>
      </ul>
    </div>
  </nav>
</div>


