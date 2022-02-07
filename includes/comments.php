<?php include "config.php"; ?>
<?php include "functions.php"; ?>
<?php include "sessions.php"; ?>
<?php 

$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];

Confirm_Login();

?>

<!DOCTYPE html>
<html lang = "en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel = "stylesheet" href = "css/styles.css">
    <title> Comments </title>
</head>
<body>
<!-- NAVBAR -->
<div style = "height: 10px; background: #27AAE1;"></div>
    <nav class = "navbar navbar-expand-lg navbar-dark bg-dark">
        <div class = "container">
        <h1 class="navbar-brand" style = "font-family:Century Gothic;color:darkgray;"><strong><i> NewsLive </i></strong></h1>  
            <button class = "navbar-toggler" data-toggle = "collapse" data-target = "#navbarcollapseMENU">
                <span class = "navbar-toggler-icon"></span>
            </button>
                <div class = "collapse navbar-collapse" id = "navbarcollapseMENU">
                <ul class = "navbar-nav mr-auto">
                    <li class = "nav-item">
                        <a href  = "../myprofile.php" class = "nav-link" style = "font-family:Book Antiqua;"><i class="fas fa-user text-success"></i> My Profile </a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "../dashboard.php" class = "nav-link" style = "font-family:Book Antiqua;"> Dashboard </a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "../posts.php?page=1" class = "nav-link" style = "font-family:Book Antiqua;"> Posts </a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "../categories.php" class = "nav-link" style = "font-family:Book Antiqua;"> Categories</a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "../admins.php" class = "nav-link" style = "font-family:Book Antiqua;"> Manage Admins</a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "comments.php" class = "nav-link" style = "font-family:Book Antiqua;"> Comments</a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "../blog.php?page=1" target = "_blank" class = "nav-link" style = "font-family:Book Antiqua;" > Live BLog</a>
                    </li>
                </ul>
                <ul class = "navbar-nav ml-auto">
                    <li class = "nav-item">
                        <a href = "../logout.php" class = "nav-link" style = "font-family:Book Antiqua;"><i class="fas fa-user-times text-danger"></i> Logout</a>
                    </li>
                </div>
        </div>
    </nav>
<div style = "height: 10px; background: #27AAE1;"></div>
<!--NAVBAR END -->
<!-- HEADER -->
<header class = "bg-dark text-white py-3">
<div class = "container">
    <div class = "row">
        <div class = "col-md-12">
    <h1 style = "font-family: Broadway;"><i class = "fas fa-comments" style = "color: #27AAE1;"></i><i> Manage Comments </i></h1>
        </div>


    </div>
</div>
</header>
<br>
<!-- END HEADER --> 

<section class = "container py-2 mb-4">
    <div class = "row" style="min-height: 30px;">
        <div class = "col-lg-12" style="min-height: 400px;">
        <?php 
                echo ErrorMessage();
                echo SuccessMessage();
            ?>
            <h2 style="font-size: 30px; font-family:Century Gothic; color:gray;"><strong><i> Un-Approved Comments </i></strong></h2>
            <table class = "table table-striped table-hover">
                <thead class = "thead-dark">
                    <tr>
                        <th> No. </th>
                        <th> Name </th>
                        <th> Comment </th>
                        <th> Date&Time </th>
                        <th> Action </th>
                        <th> Details </th>
                    </tr>
                </thead>
        <?php 

        $sql_comment = "SELECT * FROM comments WHERE status = 'OFF' ORDER BY comment_id DESC";

        $run_comment = mysqli_query($connect,$sql_comment);

        $srNo = 0;

        while ($show_comment = mysqli_fetch_array($run_comment)) {

            $commentID = $show_comment["comment_id"];
            $commentName = $show_comment["name"];
            $comment= $show_comment["comment"];
            $commentPostID = $show_comment["post_id"];
            $DateTime = $show_comment["datetime"];
            $srNo++;
        
        ?>
                <tbody>
                    <tr>
                        <td><?php echo htmlentities($srNo); ?></td>
                        <td><?php echo htmlentities($commentName); ?></td>
                        <td><?php echo htmlentities($comment); ?></td>
                        <td><?php echo htmlentities($DateTime); ?></td>
                        <td> 
                            <a href="approveComment.php?id=<?php echo $commentID; ?>" title = "Approve"><span class = "fas fa-check-circle" style="color: green;"></span></a>
                            &nbsp;&nbsp;
                            <a href="deleteComment.php?id=<?php echo $commentID; ?>" title = "Delete"><span class = "fas fa-trash-alt" style="color: Red;"></span></a>
                        </td>
                        <td> 
                            <a href="../fullpost.php?id=<?php echo $commentPostID; ?>" target = "_blank"><span class = "btn btn-info btn-block"> Live Preview </span></a>
                       </td>
                    </tr>
                </tbody>
        <?php } ?>
            </table>
            <h2 style="font-size: 30px; font-family:Century Gothic; color:gray;"><strong><i> Approved Comments </i></strong></h2>
            <table class = "table table-striped table-hover">
                <thead class = "thead-dark">
                    <tr>
                        <th> No. </th>
                        <th> Name </th>
                        <th> Comment </th>
                        <th> Date&Time </th>
                        <th> Action </th>
                        <th> Details </th>
                    </tr>
                </thead>
        <?php 

        $sql_comment = "SELECT * FROM comments WHERE status = 'ON' ORDER BY comment_id DESC";

        $run_comment = mysqli_query($connect,$sql_comment);

        $srNo = 0;

        while ($show_comment = mysqli_fetch_array($run_comment)) {

            $commentID = $show_comment["comment_id"];
            $commentName = $show_comment["name"];
            $comment= $show_comment["comment"];
            $commentPostID = $show_comment["post_id"];
            $DateTime = $show_comment["datetime"];
            $srNo++;
        
        ?>
                <tbody>
                    <tr>
                        <td><?php echo htmlentities($srNo); ?></td>
                        <td><?php echo htmlentities($commentName); ?></td>
                        <td><?php echo htmlentities($comment); ?></td>
                        <td><?php echo htmlentities($DateTime); ?></td>
                        <td> 
                            <a href="DisapproveComment.php?id=<?php echo $commentID; ?>" title = "Disapprove"><span class = "fas fa-ban" style="color: brown;"></span></a>
                            &nbsp;&nbsp;
                            <a href="deleteComment.php?id=<?php echo $commentID; ?>" title = "Delete"><span class = "fas fa-trash-alt" style="color:Red;"></span></a>
                        </td>
                        <td> 
                            <a href="../fullpost.php?id=<?php echo $commentPostID; ?>" target = "_blank"><span class = "btn btn-info btn-block"> Live Preview </span></a>
                       </td>
                    </tr>
                </tbody>
        <?php } ?>
            </table>
        </div>
    </div>

</section>
<!-- FOOTER --> 
<footer class = "bg-dark text-white">
    <div class = "container">
        <div class = "row">
            <div class = "col">
            <p class = "lead text-center">Theme by | NgBlog | <span id = "year"></span> &copy; -----All right Reserved. </p>
            <p class = "text-center small"><a style = "color: white; text-decoration: none; cursor: pointer;" href= "https://ngblog.com/coupons/" target = "_blank">
            This is the Offical Site fot the Ngblog Society<br> &trade; NgBlog.com &trade; Facebook</a></p>
            </div>
        </div>
    </div>
</footer>
<div style = "height: 10px; background: #27AAE1;"></div>
<!-- END FOOTER -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script>
    $("#year").text(new Date().getFullYear());
</script>
</body>
</html>