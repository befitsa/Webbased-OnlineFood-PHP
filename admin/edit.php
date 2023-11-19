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
    <title>Edit Delivery Person</title>
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
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Update the delivery person's information in the database
    $updateQuery = "UPDATE delivery SET name='$name', email='$email', phone='$phone', address='$address' WHERE id='$id'";
    $result = mysqli_query($db, $updateQuery);

    if ($result) {
        // Update successful
        echo '<script>';
        echo 'alert("Delivery person information updated successfully!");';
        echo 'window.location.href = "delivery_fetch.php";';
        echo '</script>';
        exit();
    } else {
        // Error occurred while updating the information
        echo '<script>';
        echo 'alert("Error: ' . mysqli_error($db) . '");';
        echo '</script>';
    }
}

// Fetch the delivery person's information based on the ID from the URL parameter
$id = $_GET['id'];
$selectQuery = "SELECT * FROM delivery WHERE id='$id'";
$result = mysqli_query($db, $selectQuery);
$row = mysqli_fetch_assoc($result);
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
                    <h2>Edit Delivery Person</h2>

                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <label for="name">Full Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea class="form-control" id="address" name="address" required><?php echo $row['address']; ?></textarea>
                        </div>

                        <button type="submit" name='update' class="btn btn-primary">Update</button>
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
