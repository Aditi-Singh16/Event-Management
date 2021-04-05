<?php
$msg="";
if(isset($_POST['submit'])){
  $fname = $_POST['first_name'];
  $mname = $_POST['middle_name'];
  $lname = $_POST['last_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $dept = $_POST['dept'];
  $designation = $_POST['designation'];

    include 'conn.php';

    $check = mysqli_num_rows(mysqli_query($con,"SELECT * FROM `staff` WHERE `email`='$email'"));

    if($check>0){
      $msg = "Email id already exists";
    }
    else {
      mysqli_query($con,"INSERT INTO `staff`(`Fname`, `Mname`, `Lname`, `password`, `email`, `dept_id`, `designation`)
      VALUES ('$fname', '$mname', '$lname', '$password', '$email', '$dept', '$designation')");
      header('location: login.php');
  }
}
 ?>
 
 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="vendor/jquery-ui/jquery-ui.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="navbar.css">

    <link rel="stylesheet" href="staff.css">
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
    <div class="main">

        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form" action="">
                        <h1>STAFF REGISTRATION FORM</h1>
                        <div class="echo-msg" style="color: red;">
                        <?php
                        echo $msg;
                        ?>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name">First name</label>
                                <input type="text" class="form-input" name="first_name" id="first_name" required/>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Middle name</label>
                                <input type="text" class="form-input" name="middle_name" id="middle_name" required/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="last_name">Last name</label>
                                <input type="text" class="form-input" name="last_name" id="last_name" required />
                            </div>
                            <div class="form-group">
                                <label for="email">VES Email</label>
                                <input type="email" class="form-input" name="email" id="email" required/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <select class="custom-select form-control" name="designation" id="designation" required>
                                    <option class="paras">--Select Designation-- </option>
                                    <option value="Super Admin">Super Admin</option>
                                    <option value="Principal">Principal</option>
                                    <option value="HOD">HOD</option>
                                    <option value="Faculty Incharge">Faculty Incharge</option>
                                    <option value="Staff">Staff</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dept">Department</label>
                                <select class="custom-select form-control" name="dept" required>
                                    <option class="paras">--Select Department-- </option>
                                    <option value="1">INST</option>
                                    <option value="2">CMPN</option>
                                    <option value="3">INFT</option>
                                    <option value="4">EXTC</option>
                                    <option value="5">ETRX</option>
                                    <option value="6">H&AS</option>
                                    <option value="7">DSAI</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-input" name="password" id="password" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Submit" />
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>