<?php
require_once('../database.php');
session_start();
if(isset($_SESSION['username'])){
  header('location: index.php');
}

if(isset($_POST['sign-in'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $input_error = array();
    if(empty($email)){
        $input_error['email']="Enter your email or username";
    }
    if(empty($password)){
        $input_error['password']="Enter your password";
    }
    /*echo '<pre>';
    print_r($input_error);*/
    $count_input_error = count($input_error);
    if($count_input_error==0){
        $user_check = mysqli_query($link, "SELECT * FROM `librarians` WHERE `email`='$email' OR `username`='$email' ");
        $count_user_row = mysqli_num_rows($user_check);
        if($count_user_row==1){
            $pass = md5($password);
            $row = mysqli_fetch_assoc($user_check);
            if($pass==$row['password']){
                if($row['status']==1){
                    $_SESSION['librarian_name']=$row['name'];
                    $_SESSION['librarian_username']=$row['username'];
                    $_SESSION['librarian_email']=$row['email'];
                    $_SESSION['librarian_id']=$row['id'];
                    header('location: index.php?success');
                }else{
                    $error = "Your account status is now inactive";

                }
            }else{
                $error = "Password is wrong";
            }
        }else{
            $error = "Username or Email is wrong";
        }
    }else{
        $error = "Something is wrong";
    }
}

?>









<!doctype html>
<html lang="en" class="fixed accounts sign-in">


<!-- Mirrored from myiideveloper.com/helsinki/last-version/helsinki_green-dark/src/pages_sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Mar 2019 13:05:33 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Sign In | LMS</title>
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/vendor/animate.css/animate.css">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/stylesheets/css/style.css">
</head>

<body>
<div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LOGO-->
        <div class="logo">
            <h2 class="text-center">Library Managment System</h2>
        </div>

        <div class="box">
            <!--SIGN IN FORM-->
            <div class="panel mb-none">
                <h3>Login Form</h3>
                <div class="panel-content bg-scale-0">
                    <?php 
                    if(isset($_GET['added'])){
                        ?>
                        <div class="alert alert-success alert-dismissable">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                           <strong>Your registration completed successfully</strong>
                        </div>
                    <?php } ?>

                    <?php 
                    if(isset($error)){
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?=$error?>
                        </div>
                    <?php } ?>

                    <form action="" method="POST">
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email or Username" value="<?php if(isset($email)){echo $email;}?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <span class="text-danger"><?php if(isset($input_error['email'])){echo $input_error['email'];}?></span>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php if(isset($password)){echo $password;}?>">
                                <i class="fa fa-key"></i>
                            </span>
                            <span class="text-danger"><?php if(isset($input_error['password'])){echo $input_error['password'];}?></span>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary btn-block" type="submit" name="sign-in" value="Sign In">
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
<!--BASIC scripts-->
<!-- ========================================================= -->
<script src="../assets/vendor/jquery/jquery-1.12.3.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/vendor/nano-scroller/nano-scroller.js"></script>
<!--TEMPLATE scripts-->
<!-- ========================================================= -->
<script src="../assets/javascripts/template-script.min.js"></script>
<script src="../assets/javascripts/template-init.min.js"></script>
<!-- SECTION script and examples-->
<!-- ========================================================= -->
</body>
</html>
