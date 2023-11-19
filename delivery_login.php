<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Delivery Login</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

  <link rel="stylesheet" href="css/login.css">

  <style type="text/css">
    #buttn {
      color: #fff;
      background-color: #5c4ac7;
    }
  </style>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animsition.min.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <header id="header" class="header-scroll top-header headrom">
    <nav class="navbar navbar-dark">
      <div class="container" style="font-size:13px">
        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
        <a style="font-size:13px" class="navbar-brand" href="index.php"> Mesob Food Ordering and Delivery </a>
        <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
          <ul class="nav navbar-nav">
            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span class="sr-only"></span></a> </li>
            
            <?php
            if (empty($_SESSION["delivery_id"])) {
              echo '<li class="nav-item"> <a class="nav-link active" href="delivery_login.php" style="font-size:14px">Delivery <span class="sr-only"></span></a> </li>';
            } else {
              echo '<li class="nav-item"><a href="orders.php" class="nav-link active"> Orders</a> </li>';
              echo '<li class="nav-item"><a href="delivery_logout.php" class="nav-link active">Logout</a> </li>';
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <div style="background-image: url('images/img/restrrr.png');">
    <?php
    include("connection/connect.php");
    error_reporting(0);
    session_start();

    if (isset($_POST['submit'])) {
      $email = $_POST['email'];
      $password = md5($_POST['password']);

      if (!empty($_POST["submit"])) {
        $loginquery = "SELECT * FROM delivery WHERE email='$email' AND password='$password'";
        $result = mysqli_query($db, $loginquery);
        $row = mysqli_fetch_array($result);

        if (is_array($row)) {
          $_SESSION["delivery_id"] = $row['id'];
          header("refresh:1;url=orders.php");
        } else {
          $message = "Invalid Username or Password!";
        }
      }
    }
    ?>

    <div class="pen-title"></div>

    <div class="module form-module">
      <div class="toggle"></div>
      <div class="form">
        <h2>Login to your account</h2>
        <span style="color:red;"><?php echo $message; ?></span>
        <span style="color:green;"><?php echo $success; ?></span>
        <form action="" method="post">
          <input type="text" placeholder="Email" name="email" required />
          <input type="password" placeholder="Password" name="password" required />
          <input type="submit" id="buttn" name="submit" value="Login" />
        </form>
        <a href="forgot_delivery.php" style="color:red">Forgot password</a>
      </div>
    </div>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <div class="container-fluid pt-3">
      <p></p>
    </div>

    <?php include("footer.php"); ?>
  </div>
</body>

</html>
