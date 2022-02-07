<?php include "includes/config.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "includes/sessions.php"; ?>

<?php

if (isset($_SESSION["User_ID"])) {
    
    Redirect_to("dashboard.php");
}
if (isset($_POST["Submit"])) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        $_SESSION["ErrorMessage"] = "All fields must be filled out";
        Redirect_to("login.php");
    } else {
    
        $sql_login = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";

        $result = mysqli_query($connect, $sql_login);

        while($row_login = mysqli_fetch_array($result)) {

            $admin_id = $row_login["admin_id"];
            $UserName = $row_login["username"];
            $admin_name = $row_login["admin_name"];
    
        if (mysqli_num_rows($result) == 1 ) {
            $_SESSION["User_ID"] = $admin_id;
            $_SESSION["username"] = $username;
            $_SESSION["AdminName"] = $admin_name;
            $_SESSION["SuccessMessage"] = "Welcome ".$_SESSION["AdminName"];
            if (isset($_SESSION["TrackingURL"])) {
                Redirect_to($_SESSION["TrackingURL"]);
            } else {
             Redirect_to("dashboard.php");
            }
        } else {
            $_SESSION["ErrorMessage"] = "User Name or Password is incorrect";
            Redirect_to("login.php");
        }
        // mysqli_stmt_close($stmt);
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
    <title> Login </title>
</head>
<body>
<!-- NAVBAR -->
<div style = "height: 10px; background: #27AAE1;"></div>
    <nav class = "navbar navbar-expand-lg navbar-dark bg-dark">
        <div class = "container">
            <a href = "#" class = "navbar-brand" style = "font-family:Broadway;"> NGBLOG.COM</a>
            <button class = "navbar-toggler" data-toggle = "collapse" data-target = "#navbarcollapseMENU">
                <span class = "navbar-toggler-icon"></span>
            </button>
                <div class = "collapse navbar-collapse" id = "navbarcollapseMENU">
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
        </div>
    </div>
</div>
</header>
<!-- END HEADER --> 
<!-- Main Area Start -->
<section class = "container py-2 mb-4">
<div class = "row">
    <div class = "offset-sm-3 col-sm-6" style = "min-height:500px;">
    <br><br><br>
    <?php 
        echo ErrorMessage();
        echo SuccessMessage();
    ?>
        <div class = "card bg-secondary text-light">
            <div class = "card-header">
                <h4 style = "font-size:30px; font-family:Broadway; color:HoneyDew;"><strong><i> Welcome Back </i></strong></h4>
            </div>
                <div class = "card-body bg-dark">
                <form action = "login.php" method = "post">
                    <div class = "form-group">
                        <label for = "username"> <span class = "FieldInfo"> Username: </span></label>
                        <div class = "input-group mb-3">
                            <div class = "input-group-prepend">
                                <span class = "input-group-text text-gery"><i class = "fas fa-user"></i></span>
                            </div>
                            <input type = "text" class = "form-control" name = "username" id = "username" value = "">
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for = "password"> <span class = "FieldInfo"> Password: </span></label>
                        <div class = "input-group mb-3">
                            <div class = "input-group-prepend">
                                <span class = "input-group-text text-gery"><i class = "fas fa-lock"></i></span>
                            </div>
                            <input type = "password" class = "form-control" name = "password" id = "password" value = "">
                        </div>
                    </div>
                    <input type = "submit" name = "Submit" class = "btn btn-info btn-block" value = "Login">
                </form>
                </div>
        </div>
    </div>
</div>
</section>
<!-- Main Area End -->
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