<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

if (isset($_POST['form_review'])) {
    $res_id = $_POST['res_id'];
    $cust_id = $_SESSION["user_id"];

    $check_query = "SELECT * FROM rating WHERE res_id='$res_id' AND cust_id='$cust_id'";
    $check_result = mysqli_query($db, $check_query);
    $total = mysqli_num_rows($check_result);

    if ($total) {
        $error_message = "You have already submitted a review.";
    } else {
        $res_id = $_POST['res_id'];
        $cust_id = $_SESSION["user_id"];
        $comment = $_POST['comment-' . $res_id];
        $rating = $_POST['rating-' . $res_id];        

        $insert_query = "INSERT INTO rating (res_id, cust_id, comment, rating) VALUES ('$res_id', '$cust_id', '$comment', '$rating')";
        mysqli_query($db, $insert_query);

        // Display success message as JavaScript alert
        echo '<script>alert("Review submitted successfully.");</script>';
    }
}

// Getting the average rating for this product
$t_rating = 0;
$res_id = $_POST['res_id'];
$rating_query = "SELECT r.rating, u.f_name, u.l_name, r.comment FROM rating r JOIN users u ON r.cust_id = u.u_id WHERE r.res_id='$res_id'";
$rating_result = mysqli_query($db, $rating_query);
$tot_rating = mysqli_num_rows($rating_result);

if ($tot_rating == 0) {
    $avg_rating = 0;
} else {
    while ($row = mysqli_fetch_assoc($rating_result)) {
        $t_rating += $row['rating'];
    }
    $avg_rating = $t_rating / $tot_rating;
}
?>
<head>
    <!-- Head section -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Restaurants</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Body section -->

    <?php include("header.php"); ?>

    <div class="page-wrapper">
        <!-- Page content -->
        <section class="restaurants-page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">
                <!-- Sidebar content -->
            </div>
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
                <!-- Main content -->
                <div class="bg-gray restaurant-entry">
                    <?php
                    $ress = mysqli_query($db, "SELECT * FROM restaurant");
                    while ($rows = mysqli_fetch_array($ress)) {
                        $res_id = $rows['rs_id'];

                        // Retrieve average rating for the restaurant
                        $rating_query = "SELECT AVG(rating) AS average_rating FROM rating WHERE res_id = '$res_id'";
                        $rating_result = mysqli_query($db, $rating_query);
                        $rating_row = mysqli_fetch_assoc($rating_result);
                        $avg_rating = $rating_row['average_rating'];

                        // Retrieve total number of ratings for the restaurant
                        $total_query = "SELECT COUNT(*) AS total_ratings FROM rating WHERE res_id = '$res_id'";
                        $total_result = mysqli_query($db, $total_query);
                        $total_row = mysqli_fetch_assoc($total_result);
                        $tot_rating = $total_row['total_ratings'];

                        echo '
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                                <div class="entry-logo">
                                    <a class="img-fluid" href="dishes.php?res_id=' . $res_id . '">
                                        <img src="admin/Res_img/' . $rows['image'] . '" alt="Food logo">
                                    </a>
                                </div>
                                <div class="entry-dscr">
                                    <h5>
                                        <a href="dishes.php?res_id=' . $res_id . '">' . $rows['title'] . '</a>
                                    </h5>
                                    <span>' . $rows['address'] . '</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                                <div class="right-content bg-white">
                                    <div class="right-review">
                                        <a href="dishes.php?res_id=' . $res_id . '" class="btn btn-purple">View Menu</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="rating">';
                        
                        // Display star rating for the restaurant
                        if ($avg_rating == 0) {
                            echo '<p>No ratings yet.</p>';
                        } else {
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i > $avg_rating) {
                                    echo '<i class="fa fa-star-o" style="color:gold"></i>';
                                } else {
                                    echo '<i class="fa fa-star" style="color:gold"></i>';
                                }
                            }
                        }

                        echo '</div>';

                        // Check if the user is logged in
                        if (isset($_SESSION["user_id"])) {
                            $cust_id = $_SESSION["user_id"];

                            $check_query = "SELECT * FROM rating WHERE res_id = '$res_id' AND cust_id = '$cust_id'";
                            $check_result = mysqli_query($db, $check_query);
                            $total = mysqli_num_rows($check_result);

                            if ($total == 0) {
                                echo '
                                <form action="" method="post">
                                    <div class="rating-section">
                                        <div class="rating-stars">
                                            <input type="radio" id="star5-' . $res_id . '" name="rating-' . $res_id . '" value="1" onclick="updateStarColor(' . $res_id . ', 1)" />
                                            <label for="star5-' . $res_id . '" title="5 stars"><i class="fas fa-star"></i></label>
                                            <input type="radio" id="star4-' . $res_id . '" name="rating-' . $res_id . '" value="2" onclick="updateStarColor(' . $res_id . ', 2)" />
                                            <label for="star4-' . $res_id . '" title="4 stars"><i class="fas fa-star"></i></label>
                                            <input type="radio" id="star3-' . $res_id . '" name="rating-' . $res_id . '" value="3" onclick="updateStarColor(' . $res_id . ', 3)" />
                                            <label for="star3-' . $res_id . '" title="3 stars"><i class="fas fa-star"></i></label>
                                            <input type="radio" id="star2-' . $res_id . '" name="rating-' . $res_id . '" value="4" onclick="updateStarColor(' . $res_id . ', 4)" />
                                            <label for="star2-' . $res_id . '" title="2 stars"><i class="fas fa-star"></i></label>
                                            <input type="radio" id="star1-' . $res_id . '" name="rating-' . $res_id . '" value="5" onclick="updateStarColor(' . $res_id . ', 5)" />
                                            <label for="star1-' . $res_id . '" title="1 star"><i class="fas fa-star"></i></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="comment-' . $res_id . '" class="form-control" cols="30" rows="10" placeholder="Write your comment (optional)" style="height:100px;"></textarea>
                                    </div>
                                    <input type="hidden" name="res_id" value="' . $res_id . '">
                                    <input type="submit" class="btn btn-default" name="form_review" value="Submit Review">
                                </form>

                                <style>
                                    .rating-stars {
                                        font-size: 24px;
                                    }
                                    .rating-stars input[type="radio"] {
                                        display: none;
                                    }
                                    .rating-stars label {
                                        color: #ddd;
                                        cursor: pointer;
                                    }
                                    .rating-stars label i {
                                        transition: color 0.3s;
                                    }
                                    .rating-stars label:hover i,
                                    .rating-stars input[type="radio"]:checked + label i {
                                        color: goldenrod;
                                    }
                                </style>

                                <!-- Make sure to include the Font Awesome CSS -->
                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">';
                            } else {
                                echo '<p style="color:red;">' . $error_message . '</p>';
                            }
                        } else {
                            echo '<p class="error">You need to log in to submit a review.</p>';
                        }

                        echo '<div class="comments-section">
                                <h5>User Reviews (' . $tot_rating . ')</h5>';

                        if ($tot_rating == 0) {
                            echo '<p>No reviews yet.</p>';
                        } else {
                            echo '<table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Rating</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                            $query = "SELECT r.rating, r.comment, u.f_name, u.l_name FROM rating r JOIN users u ON r.cust_id = u.u_id WHERE r.res_id = '$res_id'";
                            $result = mysqli_query($db, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>
                                        <td>' . $row['f_name'] . ' ' . $row['l_name'] . '</td>
                                        <td>';

                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i > $row['rating']) {
                                        echo '<i class="fa fa-star-o" style="color:gold"></i>';
                                    } else {
                                        echo '<i class="fa fa-star" style="color:gold"></i>';
                                    }
                                }

                                echo '</td>
                                        <td>' . $row['comment'] . '</td>
                                    </tr>';
                            }

                            echo '</tbody>
                                </table>';
                        }

                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function updateStarColor(resId, rating) {
    var starIds = ["star1-", "star2-", "star3-", "star4-", "star5-"];

    for (var i = 1; i <= 5; i++) {
        var starId = starIds[i - 1] + resId;
        var starElement = document.getElementById(starId);

        if (i <= rating) {
            starElement.style.color = "goldenrod";
        } else {
            starElement.style.color = "";
        }
    }
}
</script>


    </div>

    <?php include("footer.php"); ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="js/main.js"></script>
</body>

</html>



