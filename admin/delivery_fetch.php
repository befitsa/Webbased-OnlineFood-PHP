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
    <title>Delivery Person information</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .action-buttons {
            margin-top: 10px;
        }

        .action-buttons .btn {
            margin-right: 5px;
            padding: 5px 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>
<?php
// Fetch data from the "delivery" table
$selectQuery = "SELECT * FROM delivery";
$result = mysqli_query($db, $selectQuery);
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
                    <h4>Delivery Person information</h4>
                    <a href="add_delivery.php" style="float:right; margin-top:-20px;color:red"> Add new</a>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Display the fetched data in the table
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>".$row['name']."</td>";
                                echo "<td>".$row['email']."</td>";
                                echo "<td>".$row['phone']."</td>";
                                echo "<td>".$row['address']."</td>";
                                echo "<td class='action-buttons'>
                                    <a href='edit.php?id=".$row['id']."' class='btn btn-primary btn-sm'>Update</a>
                                    <a href='delete_delivery.php?id=".$row['id']."' class='btn btn-danger btn-sm'>Delete</a>
                                </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
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
