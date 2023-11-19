<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");  
error_reporting(0);  
session_start(); 

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Delivery Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> </head>

<body class="home">
    
       <?php include("header_delivery.php");  ?>
       <section class="hero bg-image" data-image-src="images/img/pimg.avif">
        </section>
  
  <div class="container" style="margin-top:40px">
    <div class="row">
    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white" style="font-size:12px">All Orders</h4>
                            </div>
                             
                                <div class="table-responsive m-t-40">
								<table id="myTable" class="table table-bordered table-striped">
    <thead style="font-size:12px">
        <tr>
            <th>#</th>
            <th>First Name</th>
			<th>Last Name</th>
			<th>Phone</th>
            <th>Title</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Address</th>
            <th>Status</th>
            <th>Reg-Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i =0;
        $sql = "SELECT users.*, users_orders.* FROM users INNER JOIN users_orders ON users.u_id=users_orders.u_id WHERE users_orders.status = 'paid' OR  users_orders.status = 'in process' ";
        $query = mysqli_query($db, $sql);
        if (!mysqli_num_rows($query) > 0) {
            echo '<td colspan="8"><center>No Orders</center></td>';
        } else {
            while ($rows = mysqli_fetch_array($query)) {
                $receiptImagePath = 'receipts/' . $rows['receipt'];
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $rows['f_name']; ?></td>
					<td><?php echo $rows['l_name']; ?></td>
					<td><?php echo $rows['phone']; ?></td>
                    <td><?php echo $rows['title']; ?></td>
                    <td><?php echo $rows['quantity']; ?></td>
                    <td>ETB <?php echo $rows['price']; ?></td>
                    <td><?php echo $rows['address']; ?></td>
                    <td>
                        <?php
                        $status = $rows['status'];
                        if ($status == "" or $status == "NULL") {
                            echo '<button type="button" class="btn btn-info"><span class="fa fa-bars"  aria-hidden="true"></span>ordered</button>';
                        } elseif ($status == "in process") {
                            echo '<button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin"  aria-hidden="true"></span> On The Way!</button>';
                        } elseif ($status == "closed") {
                            echo '<button type="button" class="btn btn-primary"><span class="fa fa-check-circle" aria-hidden="true"></span> Delivered</button>';
                        } elseif ($status == "rejected") {
                            echo '<button type="button" class="btn btn-danger"><i class="fa fa-close"></i> Cancelled</button>';
                        }
                        ?>
                    </td>
                    <td><?php echo $rows['date']; ?></td>
                    <td>
                        
                        <a href="view_order.php?user_upd=<?php echo $rows['o_id']; ?>" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>


                                </div>
                            </div>
                        </div>
                            </div>
                            </div>
     <?php  include("footer.php");  ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>                           