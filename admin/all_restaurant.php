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
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>All Restaurants</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body >
<?php   include("header.php"); ?>
<div class="container-fluid">
    <div class="row">
       <div style="overflow-y: scroll;border-right:2px solid orange;" class="col-sm-2" >
  <?php include("sidebar.php"); ?>
</div>
<div class="col-sm-10">
<div class="table-responsive m-t-40">
            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead class="thead-blue" style="font-size:10px">
            <tr>
            <th>Category</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Url</th>
            <th>Open Hrs</th>
            <th>Close Hrs</th>
            <th>Open Days</th>
            <th>Address</th>
            <th>Image</th>
            <th>Date</th>
            <th>Action</th>  
            </tr>
            </thead>
                        <tbody>					                      
            <?php
            $sql="SELECT * FROM restaurant order by rs_id desc";
            $query=mysqli_query($db,$sql);

            if(!mysqli_num_rows($query) > 0 )
            {
            echo '<td colspan="11"><center>No Restaurants</center></td>';
            }
            else
            {				
            while($rows=mysqli_fetch_array($query))
            {

            $mql="SELECT * FROM res_category where c_id='".$rows['c_id']."'";
            $res=mysqli_query($db,$mql);
            $row=mysqli_fetch_array($res);

            echo ' <tr><td>'.$row['c_name'].'</td>
            <td>'.$rows['title'].'</td>
            <td>'.$rows['email'].'</td>
            <td>'.$rows['phone'].'</td>
            <td>'.$rows['url'].'</td>


            <td>'.$rows['o_hr'].'</td>
            <td>'.$rows['c_hr'].'</td>
            <td>'.$rows['o_days'].'</td>

            <td>'.$rows['address'].'</td>

            <td><div class="col-md-3 col-lg-8 m-b-10">
            <center><img src="Res_img/'.$rows['image'].'" class="img-responsive radius"  style="min-width:150px;min-height:100px;"/></center>
            </div></td>

            <td>'.$rows['date'].'</td>
            <td><a href="delete_restaurant.php?res_del='.$rows['rs_id'].'" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
            <a href="update_restaurant.php?res_upd='.$rows['rs_id'].'" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
            </td></tr>';



}	
}

?>
</tbody>
</table>
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
    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>
</body>

</html>