<?php include "includes/config.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/sessions.php"; ?>
<?php 

$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];

Confirm_Login(); ?>

<?php

if(isset($_POST["Submit"])) {

    $cat_name = $_POST["Title"];
    $admin = $_SESSION["AdminName"];
    date_default_timezone_set("Africa/Lagos");
    $time = time();
    $date = date("F d, Y h:i:s a", $time);

    if (empty($cat_name)) {
        $_SESSION["ErrorMessage"] = "All fields must be filled out";
        Redirect_to("categories.php");
    } elseif (strlen($cat_name) < 2) {
        $_SESSION["ErrorMessage"] = "Category Title should be greater than 2 characters";
        Redirect_to("categories.php");
    } elseif (strlen($cat_name) > 15) {
        $_SESSION["ErrorMessage"] = "Category Title should be less than 15 characters";
        Redirect_to("categories.php");
    }else {
        $insert_cat = "INSERT INTO category (title, author, datetime) VALUES (?, ?, ?)";
        if($stmt = mysqli_prepare($connect, $insert_cat)) {
        mysqli_stmt_bind_param($stmt, "sss", $param_title, $param_author, $param_datetime);

         $param_title = $cat_name;
         $param_author = $admin;
         $param_datetime = $date;

        if(mysqli_stmt_execute($stmt)) {
            $_SESSION["SuccessMessage"] = "Category Added Successfully.";
            Redirect_to("Categories.php");
            exit();
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Prepare statement error: " . mysqli_error($connect);
        }
    }
}

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
    <title> Categories </title>
</head>
<body>
<!-- NAVBAR -->
<div style = "height: 10px; background: #27AAE1;"></div>
    <nav class = "navbar navbar-expand-lg navbar-dark bg-dark">
        <div class = "container">
            <a href = "blog.php?page=1" class = "navbar-brand" style = "font-family:Book Antiqua;"> Ngblog </a>
            <button class = "navbar-toggler" data-toggle = "collapse" data-target = "#navbarcollapseMENU">
                <span class = "navbar-toggler-icon"></span>
            </button>
                <div class = "collapse navbar-collapse" id = "navbarcollapseMENU">
                <ul class = "navbar-nav mr-auto">
                    <li class = "nav-item">
                        <a href  = "myprofile.php" class = "nav-link" style = "font-family:Book Antiqua;"><i class="fas fa-user text-success"></i> My Profile </a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "dashboard.php" class = "nav-link" style = "font-family:Book Antiqua;"> Dashboard </a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "posts.php?page=1" class = "nav-link" style = "font-family:Book Antiqua;"> Posts </a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "categories.php" class = "nav-link" style = "font-family:Book Antiqua;"> Categories</a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "admin.php" class = "nav-link" style = "font-family:Book Antiqua;"> Manage Admins</a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "comments.php" class = "nav-link" style = "font-family:Book Antiqua;"> Comments</a>
                    </li>
                    <li class = "nav-item">
                        <a href  = "blog.php?page=1" class = "nav-link" style = "font-family:Book Antiqua;" > Live BLog</a>
                    </li>
                </ul>
                <ul class = "navbar-nav ml-auto">
                    <li class = "nav-item">
                        <a href = "logout.php" class = "nav-link" style = "font-family:Book Antiqua;"><i class="fas fa-user-times text-danger"></i> Logout</a>
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
    <h1 style = "font-family: Broadway;"><i class = "fas fa-edit" style = "color: #27AAE1;"></i> Manage Categories </h1>
        </div>


    </div>
</div>
</header>
<br>
<!-- END HEADER --> 
<!-- Main Area -->

<section class = "container py-2 mb-4">
    <div class = "row">
        <div class = "offset-lg-1 col-lg-10"style = "min-height: 400px;">
            <?php echo ErrorMessage();
                  echo SuccessMessage();
            ?>
            <form action = "categories.php" method = "post">
                <div class = "card bg-secondary text-dark mb-3">
                    <div class = "card-header">
                        <h1 style = "font-family: Century Gothic; font-size: 40px; color:DarkGray;"><strong><i> Add New Category </i></strong></h1>
                    </div>
    <div class = "card-body bg-dark">
        <div class = "form-group">
            <label for = "title"><span class = "FieldInfo"> Category Title: </span></label>
                <input class = "form-control" type = "text" name = "Title" id = "title" placeholder = "Type title here" value = "" style = "font-family: Century Gothic;">
        </div>
            <div class = "row">
                <div class = "col-lg-6 mb-2">
                    <a href = "dashboard.php" class = "btn btn-warning btn-block" style = "font-family: Century Gothic;"><i class = "fas fa-undo-alt"></i> Back to Dashboard </a>
                </div>

                <div class = "col-lg-6 mb-2">
                    <button type = "submit" name = "Submit" class = "btn btn-success btn-block" style = "font-family: Century Gothic;">
                        <i class = "fas fa-check"></i> New Category
                    </button>
            </div>
                </div>
    </div>
                </div>
           </form>
           <br><br>
           </table>
            <h2 style="font-size: 30px; font-family:Century Gothic; color:gray;"><strong><i> Existing Categories </i></strong></h2>
            <table class = "table table-striped table-hover">
                <thead class = "thead-dark">
                    <tr>
                        <th> No. </th>
                        <th> Category Name </th>
                        <th> Created By </th>
                        <th> Date&Time </th>
                        <th> Action </th>
                    </tr>
                </thead>
        <?php 
        
        $sql_cat = "SELECT * FROM category ORDER BY id desc";

        $run_cat = mysqli_query($connect,$sql_cat);

        $srNo = 0;

        while ($show_cat = mysqli_fetch_array($run_cat)) {

            $catID = $show_cat["id"];
            $catName = $show_cat["title"];
            $catAuthor = $show_cat["author"];
            $DateTime = $show_cat["datetime"];
            $srNo++;
        
        ?>
                <tbody>
                    <tr>
                        <td><?php echo htmlentities($srNo); ?></td>
                        <td><?php echo htmlentities($catName); ?></td>
                        <td><?php echo htmlentities($catAuthor); ?></td>
                        <td><?php echo htmlentities($DateTime); ?></td>
                        <td> 
                            <a href="includes/deleteCategory.php?id=<?php echo $catID; ?>" title = "Delete"><span class = "fas fa-trash-alt" style="color:Red;"></span></a>
                        </td>
                    </tr>
                </tbody>
        <?php } ?>
            </table>
        </div>
    </div>

</section>

<!-- ENd Main Area -->
<!-- FOOTER --> 
<footer class = "bg-dark text-white" style = "font-family:Century Gothic;">
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