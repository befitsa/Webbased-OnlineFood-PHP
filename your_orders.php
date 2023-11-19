<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

if(empty($_SESSION['user_id']))  
{
	header('location:login.php');
}
else
{
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>My Orders</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
<style type="text/css" rel="stylesheet">


.indent-small {
  margin-left: 5px;
}
.form-group.internal {
  margin-bottom: 0;
}
.dialog-panel {
  margin: 10px;
}
.datepicker-dropdown {
  z-index: 200 !important;
}
.panel-body {
  background: #e5e5e5;
  /* Old browsers */
  background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* FF3.6+ */
  background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
  /* Chrome,Safari4+ */
  background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* Chrome10+,Safari5.1+ */
  background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* Opera 12+ */
  background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* IE10+ */
  background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
  /* W3C */
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
  font: 600 15px "Open Sans", Arial, sans-serif;
}
label.control-label {
  font-weight: 600;
  color: #777;
}

/* 
table { 
	width: 750px; 
	border-collapse: collapse; 
	margin: auto;
	
	}

/* Zebra striping */
/* tr:nth-of-type(odd) { 
	background: #eee; 
	}

th { 
	background: #404040; 
	color: white; 
	font-weight: bold; 
	
	}

td, th { 
	padding: 10px; 
	border: 1px solid #ccc; 
	text-align: left; 
	font-size: 14px;
	
	} */ */


@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* table { 
	  	width: 100%; 
	}

	
	table, thead, tbody, th, td, tr { 
		display: block; 
	} */
	
	
	/* thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; } */
	
	/* td { 
		
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}

	td:before { 
		
		position: absolute;
	
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		
		content: attr(data-column);

		color: #000;
		font-weight: bold;
	} */

}







	</style>

	</head>

<body>
    
      
<?php include("header.php");  ?>
        <div class="page-wrapper">
       
           
    
            <div class="inner-page-hero bg-image" data-image-src="images/img/pimg.jpg">
                <div class="container"> </div>
        
            </div>
            <div class="result-show">
                <div class="container">
                    <div class="row">
                       
                       
                    </div>
                </div>
            </div>
    
            <section class="restaurants-page">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                          </div>
                        <div class="col-xs-12">
                            <div class="bg-gray">
                                <div class="row">
								
								<table class="table table-bordered table-hover">
    <thead style="background: #404040; color:white;">
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Receipt</th>
            <th>Message</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query_res = mysqli_query($db, "SELECT * FROM users_orders WHERE u_id='" . $_SESSION['user_id'] . "'");
        if (!mysqli_num_rows($query_res) > 0) {
            echo '<td colspan="6"><center>You have No orders Placed yet. </center></td>';
        } else {
            while ($row = mysqli_fetch_array($query_res)) {
                $order_id = $row['o_id'];
                $existing_receipt = $row['receipt'];
                $receipt_path = 'receipts/' . $existing_receipt;
        ?>
                <tr>
                    <td data-column="Item"> <?php echo $row['title']; ?></td>
                    <td data-column="Quantity"> <?php echo $row['quantity']; ?></td>
                    <td data-column="Price">ETB <?php echo $row['price']; ?></td>
                    <td data-column="Receipt">
                        <?php
                        // Check if a receipt is present for the order
                        if (!empty($existing_receipt)) {
                        ?>
                            <a href="<?php echo $receipt_path; ?>" target="_blank">View Receipt</a>
                            <br>
                            <form action="change_receipt.php" method="POST" enctype="multipart/form-data">
                                <input type="file" name="receipt" accept="image/*">
                                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                                <input type="hidden" name="existing_receipt" value="<?php echo $existing_receipt; ?>">
                                <input type="submit" name="submit" value="Change Receipt" class="btn btn-primary">
                            </form>
                            <?php
                            if (isset($_SESSION['receipt_message']) && $_SESSION['order_id'] == $order_id) {
                                echo '<script>alert("' . $_SESSION['receipt_message'] . '");</script>';
                                unset($_SESSION['receipt_message']);
                                unset($_SESSION['order_id']);
                            }
                            ?>
                        <?php
                        } else {
                        ?>
                            <form action="upload_receipt.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="receipt" accept="image/*" required>
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
    <input type="submit" value="Upload Receipt" class="btn btn-primary">
</form>

                            <?php
                            if (isset($_SESSION['receipt_message']) && $_SESSION['order_id'] == $order_id) {
                                echo '<script>alert("' . $_SESSION['receipt_message'] . '");</script>';
                                unset($_SESSION['receipt_message']);
                                unset($_SESSION['order_id']);
                            }
                            ?>
                        <?php
                        }
                        ?>
                    </td>
                    <td>

                    <?php
                    $x =$row['o_id'];
        $query = mysqli_query($db, "SELECT * FROM remark  WHERE frm_id='$x' ORDER BY id DESC LIMIT 1 ");
        if (mysqli_num_rows($query) > 0) {
            $rows=mysqli_fetch_array($query);
            echo $rows['remark'];
        } else  {
            echo 'No message';
        }

            ?>

                    </td>
                    <td data-column="Status">
                        <?php
                        $status = $row['status'];
                        if ($status == "" or $status == "NULL") {
                        ?>
                            <button type="button" class="btn btn-info"><span class="fa fa-bars" aria-hidden="true"></span> Your order is sent</button>
                        <?php
                        }
                        if ($status == "in process") {
                        ?>
                            <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> On The Way!</button>
                        <?php
                        }
                        if ($status == "closed") {
                        ?>
                            <button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true"></span> Delivered</button>
                        <?php
                        }
                        if ($status == "rejected") {
                        ?>
                            <button type="button" class="btn btn-danger"><i class="fa fa-close"></i> Cancelled</button>
                        <?php
                        }
                        ?>
                    </td>
                    <td data-column="Date"> <?php echo $row['date']; ?></td>
                    <td data-column="Action">
                        <a href="delete_orders.php?order_del=<?php echo $row['o_id']; ?>" onclick="return confirm('Are you sure you want to cancel your order?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10">
                            <i class="fa fa-trash-o" style="font-size:16px"></i>
                        </a>
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
                </div>
            </section>
			<?php  include("footer.php");  ?>
        </div>
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
<?php
}
?>