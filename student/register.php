<?php
require_once('../database.php');
    /*if($link){
        echo "Yes, Database connected";
    }else{
        echo "No, Database not connected";
    }*/

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $reg = $_POST['reg'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $phone = $_POST['phone'];

    //echo $_FILES['photo']['name'];
    $photo = explode('.', $_FILES['photo']['name']);
    $photo_end = end($photo);
    $photo_name = $username.'.'.$photo_end;


    /*echo '<pre>';
    print_r($_POST);*/
    $inpur_error = array();

    if (empty($name)) {
        $inpur_error['name'] = "Please enter your name";
    }
    if (empty($roll)) {
        $inpur_error['roll'] = "Please enter your roll";
    }
    if (empty($reg)) {
        $inpur_error['reg'] = "Please enter your Registration No";
    }
    if (empty($email)) {
        $inpur_error['email'] = "Please enter your email";
    }
    if (empty($username)) {
        $inpur_error['username'] = "Please enter your username";
    }
    if (empty($password)) {
        $inpur_error['password'] = "Please enter your password";
    }
    if (empty($cpassword)) {
        $inpur_error['cpassword'] = "Please enter your conform password";
    }
    if (empty($phone)) {
        $inpur_error['phone'] = "Please enter your phone";
    }
    
    $count_error = count($inpur_error);
    /*echo '<pre>';
    print_r($inpur_error);*/
    if ($count_error == 0) {
        $email_check = mysqli_query($link, "SELECT * FROM `students` WHERE `email`='$email'");
        $email_row_count = mysqli_num_rows($email_check);
        if ($email_row_count==0) {
            $username_check = mysqli_query($link, "SELECT * FROM `students` WHERE `username`='$username'");
            $username_row_count = mysqli_num_rows($username_check);
            if($username_row_count == 0){
                if($password==$cpassword){
                    if(strlen($password)>=8){
                        $pass = md5($password);
                        $status =0;
                        $datetime = date("Y-m-d H:i:s");
                        $insert_student = mysqli_query($link, "INSERT INTO `students`(`name`, `roll`, `reg`, `email`, `username`, `password`, `phone`,`photo`,`status`,`datetime`) VALUES ('$name','$roll','$reg','$email','$username','$pass','$phone','$photo_name','$status','$datetime')");
                        move_uploaded_file($_FILES['photo']['tmp_name'], 'img/'.$photo_name);
                        if($insert_student){
                            $error = "Student Successfully added"; 
                            //header('location: index.php');
                        }

                    }else{
                        $pass_poor = "Use password at least 8 characters";
                    }
                    

                }else{
                    $cpass_error = "The confirm password does not match";
                }
            }else{
                $error = "Student Already Registered by This Username";
            }
        }else{
            $error = "Student Already Registered by This Email";
        }
    }else{
        echo " No";
    }

}

?>



<!doctype html>
<html lang="en" class="fixed accounts sign-in">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Registration | LMS</title>
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
            <h1 class="text-center">LMS</h1>
        </div>
        <div class="box">
            <!--SIGN IN FORM-->
            <div class="panel mb-none">
                <h3>Registration Form</h3>
                <?php 
                if(isset($error)){
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?=$error?>
                    </div>
                <?php } ?>


                
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php if(isset($name)){echo $name;}?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <span class="text-danger"><?php if(isset($inpur_error['name'])){echo $inpur_error['name'];}?></span>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" id="roll" name="roll" placeholder="Roll" value="<?php if(isset($roll)){echo $roll;}?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <span class="text-danger"><?php if(isset($inpur_error['roll'])){echo $inpur_error['roll'];}?></span>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" id="reg" name="reg" placeholder="Reg" value="<?php if(isset($reg)){echo $reg;}?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <span class="text-danger"><?php if(isset($inpur_error['reg'])){echo $inpur_error['reg'];}?></span>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php if(isset($email)){echo $email;}?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <span class="text-danger"><?php if(isset($inpur_error['email'])){echo $inpur_error['email'];}?></span>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="username" class="form-control" id="username" name="username" placeholder="Username" value="<?php if(isset($username)){echo $username;}?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <span class="text-danger"><?php if(isset($inpur_error['username'])){echo $inpur_error['username'];}?></span>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php if(isset($password)){echo $password;}?>">
                                <i class="fa fa-key"></i>
                            </span>
                            <span class="text-danger"><?php if(isset($inpur_error['password'])){echo $inpur_error['password'];}?></span>
                            <span class="text-danger"><?php if(isset($pass_poor)){echo $pass_poor;}?></span>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
                                <i class="fa fa-key"></i>
                            </span>
                            <span class="text-danger"><?php if(isset($inpur_error['cpassword'])){echo $inpur_error['cpassword'];}?></span>
                            <span class="text-danger"><?php if(isset($cpass_error)){echo $cpass_error;}?></span>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="username" class="form-control" id="phone" name="phone" placeholder="Phone No." value="<?php if(isset($phone)){echo $phone;}?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <span class="text-danger"><?php if(isset($inpur_error['phone'])){echo $inpur_error['phone'];}?></span>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input class="form-control" type="file" id="photo" name="photo"/>
                                <i class="fa fa-photo"></i>
                            </span>
                            <span class="text-danger"><?php if(isset($inpur_error['phone'])){echo $inpur_error['phone'];}?></span>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary btn-block" type="submit" name="register" value="Register" />
                        </div>
                        <div class="form-group text-center">
                            Have an account?, <a href="sign-in.php">Sign In</a>
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
