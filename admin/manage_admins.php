<!DOCTYPE html>
<html>
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

?>
<head>
  <title>Admin Management</title>
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
          <h2>Admin Management</h2>
          <div class="scrollable-div">
            <table class="table table-striped">
              <thead>
                <tr>
                    <th>#</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Username</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i=0;
                // Fetch admin information from the database
                $query = "SELECT * FROM admin";
                $result = mysqli_query($db, $query);

                if ($result) {
                  // Display admin information in the table
                  while ($row = mysqli_fetch_assoc($result)) {
                    $i++;
                    echo '<tr>';
                    echo '<td>' .$i . '</td>';
                    echo '<td>' . $row["firstName"] . '</td>';
                    echo '<td>' . $row["lastName"] . '</td>';
                    echo '<td>' . $row["email"] . '</td>';
                    echo '<td>' . $row["phone"] . '</td>';
                    echo '<td>' . $row["username"] . '</td>';
                    echo '<td>';
                    echo '<a href="edit_admin.php?id=' . $row["adm_id"] . '" class="btn btn-primary btn-sm">Edit</a> ';
                    echo '<a href="delete_admin.php?id=' . $row["adm_id"] . '" class="btn btn-danger btn-sm">Delete</a>';
                    echo '</td>';
                    echo '</tr>';
                  }
                } else {
                  // Error occurred while fetching admin information
                  echo '<tr><td colspan="6">Error: ' . mysqli_error($db) . '</td></tr>';
                }
                ?>
              </tbody>
            </table>
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
