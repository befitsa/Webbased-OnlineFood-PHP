<!DOCTYPE html>
<html lang="en">

<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>All Ratings</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include("header.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div style="overflow-y: scroll;border-right:2px solid orange;" class="col-sm-2">
                <?php include("sidebar.php"); ?>
            </div>
            <div class="col-sm-10">
                <div class="card card-outline-primary">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered table-striped table-hover">
                            <thead style="font-size:12px">
                                <tr>
                                    <th>ID</th>
                                    <th>Comment</th>
                                    <th>Rating</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql = "SELECT * FROM rating ORDER BY id DESC";
                                $query = mysqli_query($db, $sql);

                                if (mysqli_num_rows($query) > 0) {
                                    while ($rows = mysqli_fetch_array($query)) {
                                        echo ' <tr>
                                                <td>' . $rows['id'] . '</td>
                                                <td>' . $rows['comment'] . '</td>
                                                <td>' . $rows['rating'] . '</td>
                                                <td>' . $rows['created_at'] . '</td>
                                                <td>
                                                    <a href="delete_rating.php?id=' . $rows['id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
                                                    
                                                </td>
                                            </tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="5"><center>No Ratings</center></td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    <footer class="footer"> © 2023 - Online Food Ordering System </footer>
    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
</body>

</html>
