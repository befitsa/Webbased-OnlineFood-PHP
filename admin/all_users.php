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
    <title>All Users</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<?php   include("header.php"); ?>
<div class="container-fluid">
                <div class="row">
<div style="overflow-y: scroll;border-right:2px solid orange;" class="col-sm-2" >
  <?php include("sidebar.php"); ?>
</div>
        <div class="col-sm-10">
                        <div class="card card-outline-primary">                           
                                <div class="table-responsive ">
                                    <table id="myTable" class="table table-bordered table-striped table-hover">
                                    <thead style="font-size:12px">
                                            <tr>
                                                <th>#</th>
                                                <th>Username</th>
                                                <th>FirstName</th>
                                                <th>LastName</th>
                                                <th>Email</th>
                                                <th>Phone</th>
												<th>Address</th>												
												 <th>Reg-Date</th>
												  <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                           
											
											<?php
                                            $x=0;
												$sql="SELECT * FROM users order by u_id desc";
												$query=mysqli_query($db,$sql);
												
													if(!mysqli_num_rows($query) > 0 )
														{
															echo '<td colspan="7"><center>No Users</center></td>';
														}
													else
														{				
																	while($rows=mysqli_fetch_array($query))
																		{
                                                                            $i++;
																					
																				
																				
																					echo ' <tr>
                                                                                    <td>'.$i.'</td>
                                                                                    <td>'.$rows['username'].'</td>
                                                                                      
																								<td>'.$rows['f_name'].'</td>
																								<td>'.$rows['l_name'].'</td>
																								<td>'.$rows['email'].'</td>
																								<td>'.$rows['phone'].'</td>
																								<td>'.$rows['address'].'</td>																								
																								<td>'.$rows['date'].'</td>
																									 <td><a href="delete_users.php?user_del='.$rows['u_id'].'" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
																									 <a href="update_users.php?user_upd='.$rows['u_id'].'" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
																									</td></tr>';
																		}	
														}
											?>
                            </tbody>
                            </table>
                            </div>
                            </div>
                            </div>
                         </div>
            <footer class="footer"> © 2023 - Online Food Ordering System </footer>
        </div>
    </div>
    <script src="js/lib/jquery/jquery.min.js"></script>>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
</body>
</html>