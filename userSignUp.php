<?php
$msg="";
if(isset($_POST['submit'])){
  $fname = $_POST['first_name'];
  $mname = $_POST['middle_name'];
  $lname = $_POST['last_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $dept = $_POST['dept'];

    $con = mysqli_connect("localhost","root","","event_dashboard");

    $check = mysqli_num_rows(mysqli_query($con,"SELECT * FROM `student` WHERE `email`='$email'"));

    if($check>0){
      $msg = "Email id already exists";
    }
    else {
      mysqli_query($con,"INSERT INTO `student`(`Fname`, `Mname`, `Lname`, `email`, `password`, `dept_id`) 
      VALUES ('$fname', '$mname', '$lname', '$email', '$password','$dept')");
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
    <link rel="stylesheet" href="staff.css">
    <link rel="stylesheet" href="nav.css">

</head>

<body>

    <div class="main">

        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form" action="">
                        <h1>USER REGISTRATION FORM</h1>
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
                                <label for="middle_name">Middle name</label>
                                <input type="text" class="form-input" name="middle_name" id="middle_name" required/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="last_name">Last name</label>
                                <input type="text" class="form-input" name="last_name" id="last_name" required/>
                            </div>
                            <div class="form-radio">
                                <label for="gender">Gender</label>
                                <div class="form-flex">
                                    <input type="radio" name="gender" value="male" id="male" checked="checked" />
                                    <label for="male">Male</label>

                                    <input type="radio" name="gender" value="female" id="female" />
                                    <label for="female">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">VES Email</label>
                                <input type="email" class="form-input" name="email" id="email" required/>
                            </div>
                            <div class="form-group">
                                <label for="branch">Branch</label>
                                <select class="custom-select form-control" name="dept" required>
                                    <option class="paras">--Select Branch-- </option>
                                    <option value="1">INST</option>
                                    <option value="2">CMPN</option>
                                    <option value="3">INFT</option>
                                    <option value="4">EXTC</option>
                                    <option value="5">ETRX</option>
                                    <option value="6">DSAI</option>
                                </select>
                            </div>
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
</body>

</html>
