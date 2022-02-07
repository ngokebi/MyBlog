<?php include "includes/config.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/sessions.php"; ?>
<?php 

$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];

Confirm_Login();

?>

<?php

if(isset($_POST["Submit"])) {

    $username = $_POST["username"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $ConfirmPassword = $_POST["ConfirmPassword"];
    $admin = $_SESSION["AdminName"];
    date_default_timezone_set("Africa/Lagos");
    $time = time();
    $date = date("F d, Y h:i:s a", $time);

$sql = "SELECT username FROM admin WHERE username = ?";
        
if($stmt = mysqli_prepare($connect, $sql)){
    
    mysqli_stmt_bind_param($stmt, "s", $param_username);
            
    $param_username = $username;
            
    if(mysqli_stmt_execute($stmt)) {

    mysqli_stmt_store_result($stmt);
                
    if(mysqli_stmt_num_rows($stmt) == 1) {
        $_SESSION["ErrorMessage"] = "This username is already taken.";
        Redirect_to("admin.php");
    } else {
        $username = trim($_POST["username"]);
            }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
        mysqli_stmt_close($stmt);
}
    if(empty($username) || empty($name) || empty($password) || empty($ConfirmPassword)) {
        $_SESSION["ErrorMessage"] = "All fields must be filled out";
        Redirect_to("admin.php");
    } elseif(strlen($password) < 4) {
        $_SESSION["ErrorMessage"] = "Password should be greater than 4 characters";
        Redirect_to("admin.php");
    } elseif(!preg_match("#[0-9]+#",$password)) {
        $_SESSION["ErrorMessage"] = "Your Password Must Contain At Least 1 Number!";
        Redirect_to("admin.php");
    } elseif(!preg_match("#[A-Z]+#",$password)) {
        $_SESSION["ErrorMessage"] = "Your Password Must Contain At Least 1 Uppercase Letter!";
        Redirect_to("admin.php");    
    } elseif(!preg_match("#[a-z]+#",$password)) {
        $_SESSION["ErrorMessage"] = "Your Password Must Contain At Least 1 Lowercase Letter!";
        Redirect_to("admin.php");   
    } elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$password)) {
        $_SESSION["ErrorMessage"] = "Your Password Must Contain At Least 1 Speical Character!";
        Redirect_to("admin.php");   
    } elseif($password !== $ConfirmPassword) {
            $_SESSION["ErrorMessage"] = "Passwords does not Match";
            Redirect_to("admin.php");
    } else {
        $insert_admin = "INSERT INTO admin (username, password, admin_name, addedby, datetime) VALUES (?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($connect, $insert_admin)) {
        mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_adminname, $param_addedby, $param_datetime);

         $param_username = $username;
         $param_password = $password;
         $param_adminname = $name;
         $param_addedby = $admin;
         $param_datetime = $date;

        if(mysqli_stmt_execute($stmt)) {
            $_SESSION["SuccessMessage"] = "New Admin Added Successfully.";
            Redirect_to("admin.php");
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
    <title> Admin Panel </title>
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
                        <a href  = "includes/comments.php" class = "nav-link" style = "font-family:Book Antiqua;"> Comments</a>
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
    <h1 style = "font-family: Broadway;"><i class = "fas fa-user" style = "color: #27AAE1;"></i> Manage Admin </h1>
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
            <form action = "admin.php" method = "post">
                <div class = "card bg-secondary text-dark mb-3">
                    <div class = "card-header">
                    <h1 style = "font-family: Century Gothic; font-size: 40px; color:DarkGray;"><strong><i> New Admins </i></strong></h1>
                    </div>
    <div class = "card-body bg-dark">
        <div class = "form-group">
            <label for = "username"><span class = "FieldInfo"> Username: </span></label>
                <input class = "form-control" type = "text" name = "username" id = "username" value = "" style = "font-family: Century Gothic;">
        </div>
        <div class = "form-group">
            <label for = "name"><span class = "FieldInfo"> Name: </span></label>
                <input class = "form-control" type = "text" name = "name" id = "name" value = "" style = "font-family: Century Gothic;">
        </div>
        <div class = "form-group">
            <label for = "password"><span class = "FieldInfo"> Password: </span></label>
                <input class = "form-control" type = "password" name = "password" id = "password" value = "" style = "font-family: Century Gothic;">
        </div>
        <div class = "form-group">
            <label for = "ConfirmPassword"><span class = "FieldInfo"> Confirm Password: </span></label>
                <input class = "form-control" type = "password" name = "ConfirmPassword" id = "ConfirmPassword" value = "" style = "font-family: Century Gothic;">
        </div>
            <div class = "row">
                <div class = "col-lg-6 mb-2">
                    <a href = "dashboard.php" class = "btn btn-warning btn-block" style = "font-family: Century Gothic;"><i class = "fas fa-undo-alt"></i> Back to Dashboard </a>
                </div>

                <div class = "col-lg-6 mb-2">
                    <button type = "submit" name = "Submit" class = "btn btn-success btn-block" style = "font-family: Century Gothic;">
                        <i class = "fas fa-check"></i> New Admin
                    </button>
            </div>
                </div>
    </div>
                </div>
           </form>
           <br><br>
           </table>
            <h2 style="font-size: 30px; font-family:Century Gothic; color:gray;"><strong><i> Existing Admins </i></strong></h2>
            <table class = "table table-striped table-hover">
                <thead class = "thead-dark">
                    <tr>
                        <th> No. </th>
                        <th> Username </th>
                        <th> Admin Name </th>
                        <th> Added By </th>
                        <th> Date&Time </th>
                        <th> Action </th>
                    </tr>
                </thead>
        <?php 
        
        $sql_admin = "SELECT * FROM admin ORDER BY admin_id desc";

        $run_admin = mysqli_query($connect,$sql_admin);

        $srNo = 0;

        while ($show_admin = mysqli_fetch_array($run_admin)) {

            $adminID = $show_admin["admin_id"];
            $username = $show_admin["username"];
            $admin_name = $show_admin["admin_name"];
            $addedBy = $show_admin["addedby"];
            $DateTime = $show_admin["datetime"];
            $srNo++;
        
        ?>
                <tbody>
                    <tr>
                        <td><?php echo htmlentities($srNo); ?></td>
                        <td><?php echo htmlentities($username); ?></td>
                        <td><?php echo htmlentities($admin_name); ?></td>
                        <td><?php echo htmlentities($addedBy); ?></td>
                        <td><?php echo htmlentities($DateTime); ?></td>
                        <td> 
                            <a href="includes/deleteAdmin.php?id=<?php echo $adminID; ?>" title = "Delete"><span class = "fas fa-trash-alt" style="color:Red;"></span></a>
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