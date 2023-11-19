<!DOCTYPE html>
<html>
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

?>
<head>
  <title>Ordered Foods Report</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <link href="css/style.css" rel="stylesheet">
  <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="css/helper.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style>
    .scrollable-div {
      max-height: 400px;
      overflow: scroll;
    }
  </style>
</head>
<body>
<?php
include("header.php");
?>

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
          <h2>Fetch Ordered Foods Report</h2>

          <form action="" method="POST" style="width:300px">
            <div class="form-group">
              <label for="date">Select Date:</label>
              <input type="date" class="form-control" id="date" name="date" required>
            </div>

            <button type="submit" name="fetch_report" class="btn btn-primary">Fetch Report</button>
          </form>
          <div class="scrollable-div">
            <?php    
            // Fetch ordered foods for a specific date
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['fetch_report'])) {
              $selectedDate = $_POST["date"];

              // Fetch the data from the database
              $query = "SELECT uo.o_id, uo.title, uo.quantity, uo.price, uo.status, uo.date, u.username, u.f_name, u.l_name, u.email, u.address
              FROM users_orders uo
              INNER JOIN users u ON uo.u_id = u.u_id
              WHERE DATE(uo.date) = '$selectedDate'";
              $result = mysqli_query($db, $query);

              if ($result) {
                // Display the ordered foods report in a Bootstrap table
                echo '<div class="container-fluid">';
                echo '<div class="row">';
                echo '<div class="col-sm-12">';
                echo '<h2>Ordered Foods Report for ' . $selectedDate . '</h2>';
                echo '<table class="table table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Order ID</th>';
                echo '<th>Title</th>';
                echo '<th>Quantity</th>';
                echo '<th>Price</th>';
                echo '<th>Status</th>';
                echo '<th>Date</th>';
                echo '<th>Username</th>';
                echo '<th>First Name</th>';
                echo '<th>Last Name</th>';
                echo '<th>Email</th>';
                echo '<th>Address</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<tr>';
                  echo '<td>' . $row["o_id"] . '</td>';
                  echo '<td>' . $row["title"] . '</td>';
                  echo '<td>' . $row["quantity"] . '</td>';
                  echo '<td>' . $row["price"] . '</td>';
                  echo '<td>' . $row["status"] . '</td>';
                  echo '<td>' . $row["date"] . '</td>';
                  echo '<td>' . $row["username"] . '</td>';
                  echo '<td>' . $row["f_name"] . '</td>';
                  echo '<td>' . $row["l_name"] . '</td>';
                  echo '<td>' . $row["email"] . '</td>';
                  echo '<td>' . $row["address"] . '</td>';
                  echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
              } else {
                // Error occurred while fetching the report
                echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
              }
            }
            ?>
          </div>
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
