<?php

// Start the session
session_start();

include 'conn.php';
$show = "";
if(isset($_POST['email']) && $_POST['password']){
	$email=$_POST['email'];
	$password=$_POST['password'];
	$res1=mysqli_query($con,"select * from `student` where email='$email' and password='$password'");
	$res2=mysqli_query($con,"select * from `staff` where email='$email' and password='$password'");

	$res3=mysqli_query($con,"select * from `student_body` where Email='$email' AND Password='$password'");
	$check1=mysqli_num_rows($res1);
	$check2=mysqli_num_rows($res2);
	$check3=mysqli_num_rows($res3);
	if($check1>0){
        //header('location: user.php');
        $_SESSION['usertype']="student";
        header('location: admin.php');
    }
    if($check2>0){
        while($rows=$res2->fetch_assoc())
        {
            $_SESSION['usertype']="staff";
            $_SESSION['staff_type']=$rows['designation'];
            $_SESSION['username']=$rows['Fname'];
        }
        header('location: admin.php');
    }
    if($check3>0){
        while($rows=$res3->fetch_assoc())
        {
            $_SESSION['usertype']="studentbody";
            $_SESSION['username']=$rows['Council_name'];
            echo $_SESSION['username'];
        }
        
        header('location: admin.php');
    }	
    else{
		$show = "Please enter correct login details";
	}
}
 ?>


<!doctype html>
<html lang="en">

<head>
    <title>Login </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="navbar.css">
</head>

<body>
<nav>
        <input id="nav-toggle" type="checkbox">
        <div class="logo"><strong>VESIT</strong></div>
        <ul class="links">
            <li><a href="./main.html">Back</a></li>
           
        </ul>
        <label for="nav-toggle" class="icon-burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
    </nav>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <h3 class="text-center mb-4">Have an account?</h3>
                        <div class="echo-msg" style="color: red;">
                        <?php
                        echo $show;
                        ?>
                        </div>
                        <form action="" method="POST" class="login-form">
                            <div class="form-group">
                                <input type="text" class="form-control rounded-left" placeholder="Username" name="email" required>
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" placeholder="Password" name="password"
                                    required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded submit p-3 px-5">LOGIN</button>
                            </div>
                            <div>
                                <p class="change_link">
                                    Not a member yet ? <br>
                                    <a href="userSignUp.php" class="">Sign up as USER </a> <br> 
                                    <a href="staff.php" class="">Sign up as STAFF</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>