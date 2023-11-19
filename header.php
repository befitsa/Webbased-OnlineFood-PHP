<?php
// Assuming you have a database connection established

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user_id"]) && isset($_POST['update'])) {
    // Retrieve the form data
    $f_name = $_POST["f_name"];
    $l_name = $_POST["l_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $user_name = $_POST["user_name"];

    // Update the user's profile in the database
    $query = "UPDATE users SET username='$user_name', f_name = '$f_name', l_name = '$l_name', email = '$email', phone = '$phone', address = '$address', password = '$password' WHERE u_id = " . $_SESSION["user_id"];

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
                    <a class="navbar-brand" href="index.php" style="font-size:14px"> Mesob Food Ordering and  Delivery </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php" style="font-size:14px">Home <span class="sr-only">(current)</span></a> </li>
                           

                           
							<?php
              if($_SESSION["user_id"]) {
                                // Assuming you have a database connection established
                            
                                // Perform a query to fetch the user's first name and last name
                                $query = "SELECT f_name, l_name FROM users WHERE u_id = " . $_SESSION["user_id"];
                                $result = mysqli_query($db, $query);
                            
                                // Check if the query was successful and if there is a matching user
                                if ($result && mysqli_num_rows($result) > 0) {
                                    $user = mysqli_fetch_assoc($result);
                                    $f_name = $user['f_name'];
                                    $l_name = $user['l_name'];
                            
                                    echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active" style="font-size:14px">My Orders</a></li>';
                                    echo '<li class="nav-item"><span class="nav-link active" style="font-size:14px;color:orange">logged in as ' . $f_name . ' ' . $l_name . '</span></li>';
                                    echo '<li class="nav-item"><a href="logout.php" class="nav-link active" style="font-size:14px">Logout</a></li>';
                                    echo '<li class="nav-item"> <button style="font-size:14px; background-color:#262626;color:white" type="button" class="btn " data-toggle="modal" data-target="#exampleModal">
                                    profile
                                  </button></li>';
                                  echo '<li class="nav-item"> <a class="nav-link active" href="restaurants.php" style="font-size:14px">Restaurants <span class="sr-only"></span></a> </li>
                                  <li class="nav-item"> <a class="nav-link active" href="cart.php" style="font-size:14px">My cart <span class="sr-only"></span></a> </li>';
                                }
                                 else {
                                    // Handle error if the user is not found in the database
                                    echo 'Error: User not found';
                                }
                            
                                // Remember to close the database connection
                              
                            }
                            
                            else{
                              echo '<li class="nav-item"><a href="login.php" class="nav-link active" style="font-size:14px">Login</a> </li>
                              <li class="nav-item"><a href="delivery_login.php" class="nav-link active" style="font-size:14px">Delivery</a> </li>
                              <li class="nav-item"><a href="registration.php" class="nav-link active" style="font-size:14px">Register</a> </li>
                              <li class="nav-item"> <a class="nav-link active" href="restaurants.php" style="font-size:14px">Restaurants <span class="sr-only"></span></a> </li>
                              <li class="nav-item"> <a class="nav-link active" href="cart.php" style="font-size:14px">My cart <span class="sr-only"></span></a> </li>';
              
                            }

					               	?>
							 
                        </ul>
						 
                    </div>
                </div>
            </nav>
        </header>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        if (isset($_SESSION["user_id"])) {
            // Perform a query to fetch the user's information
            $query = "SELECT * FROM users WHERE u_id = " . $_SESSION["user_id"];
            $result = mysqli_query($db, $query);

            // Check if the query was successful and if there is a matching user
            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                $f_name = $user['f_name'];
                $user_name = $user['username'];
                $l_name = $user['l_name'];
                $email =$user['email'];
                $phone =$user['phone'];
                $address =$user['address'];
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
                      <div class="form-group">
                      <label for="address">address:</label>
                      <input required type="text" class="form-control" id="l_name" name="address" value="' . $address . '">
                    </div>
                    <div class="form-group">
                      <label for="password">password:</label>
                      <input required type="text" class="form-control" id="l_name" name="password" value="' . $password . '">
                    </div>
                        <button type="submit" name="update" class="btn btn-primary col-sm-12" style="border-radius:10px">Update Profile</button>
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




