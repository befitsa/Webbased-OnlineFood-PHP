
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["delivery_id"]) && isset($_POST['delivery_update'])) {
    // Retrieve the form data
    $f_name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Update the user's profile in the database
    $query = "UPDATE delivery SET  name = '$f_name', email = '$email', phone = '$phone', address = '$address' WHERE id = " . $_SESSION["delivery_id"];

    if (mysqli_query($db, $query)) {
        // Profile updated successfully
        echo "<script>alert('Profile updated successfully..')</script>";
   

    } else {
        // Error updating profile
        echo "<script>alert('Error updating profile:')</script>";
        
    }

    // Remember to close the database connection
 
}
?>
<header id="header" class="header-scroll top-header headrom" style="font-size:12px" >
            <nav class="navbar navbar-dark" >
                <div class="container-fluid">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index_delivery.php" style="font-size:14px">Welcome, Delivery page </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index_delivery.php" style="font-size:14px">Home <span class="sr-only">(current)</span></a> </li>
                           

                           
							<?php
                            if($_SESSION["delivery_id"]){
                              // Perform a query to fetch the user's first name and last name
                              $query = "SELECT name FROM delivery WHERE id = " . $_SESSION["delivery_id"];
                              $result = mysqli_query($db, $query);
                          
                              // Check if the query was successful and if there is a matching user
                              if ($result && mysqli_num_rows($result) > 0) {
                                  $user = mysqli_fetch_assoc($result);
                                  $name = $user['name'];
                                                         
                                  echo '<li class="nav-item"><a href="orders.php" class="nav-link active" style="font-size:14px"> Orders</a></li>';
                                  echo '<li class="nav-item"><span class="nav-link active" style="font-size:14px;color:orange">logged in as ' . $name .  '</span></li>';
                                  echo '<li class="nav-item"><a href="delivery_logout.php" class="nav-link active" style="font-size:14px">Logout</a></li>';
                                  echo '<li class="nav-item"> <button style="font-size:14px; background-color:#262626;color:white" type="button" class="btn " data-toggle="modal" data-target="#exampleModa">
                                  profile
                                </button></li>';
                              }
                               else {
                                  // Handle error if the user is not found in the database
                                  echo 'Error: Delivery not found';
                              }
                            }
                            else{
                              echo '<li class="nav-item"><a href="login.php" class="nav-link active" style="font-size:14px">Login</a> </li>
                              <li class="nav-item"><a href="delivery_login.php" class="nav-link active" style="font-size:14px">Delivery</a> </li>
                              <li class="nav-item"><a href="registration.php" class="nav-link active" style="font-size:14px">Register</a> </li>
                              <li class="nav-item"> <a class="nav-link active" href="restaurants.php" style="font-size:14px">Restaurants <span class="sr-only"></span></a> </li>
                              ';
              
                            }

						               ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
       
<div class="modal fade" id="exampleModa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        // Assuming you have a database connection established

        // Check if the u_id is set in the session
        if (isset($_SESSION["delivery_id"])) {
            // Perform a query to fetch the user's information
            $query = "SELECT * FROM delivery WHERE id = " . $_SESSION["delivery_id"];
            $result = mysqli_query($db, $query);

            // Check if the query was successful and if there is a matching user
            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                $name = $user['name'];
                $email =$user['email'];
                $phone =$user['phone'];
                $address =$user['address'];
                

                // Display the user's information in editable input fields
                echo '<form action="" method="post">
                        <div class="form-group">
                          <label for="f_name"> Name:</label>
                          <input required type="text" class="form-control" id="f_name" name="name" value="' . $name . '">
                        </div>
                        <div class="form-group">
                          <label for="email">Email:</label>
                          <input required type="email" class="form-control" id="l_name" name="email" value="' . $email . '">
                        </div>
                        <div class="form-group">
                        <label for="phone">phone:</label>
                        <input required type="tel" class="form-control" id="l_name" name="phone" value="' . $phone . '">
                      </div>
                      <div class="form-group">
                      <label for="address">address:</label>
                      <input required type="text" class="form-control" id="address" name="address" value="' . $address . '">
                    </div>
                        <button type="submit" name="delivery_update" class="btn btn-primary col-sm-12" style="border-radius:10px">Update Profile</button>
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
