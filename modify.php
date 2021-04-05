<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="modify.css">
    <title>Modify</title>
    <style>
        body{
            overflow-x: hidden;
        }
        .btn {
            width: 150px
        }

        .form-group {
            padding: 10px;
        }

        .form-row {
            padding: 10px;
        }

        .container form {
            padding: 10px;
        }

        .container form .btn {
            margin: 0px 40%;
        }

        .container {
            margin: 6% auto;
            width: 80%;
            background-color: rgb(40, 45, 97);
            color: white;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
            margin: 5% auto;
        }
        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #add8e6;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.14.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/14f5cf4f5a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">VESIT</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                // print_r($_SESSION);
                if ($_SESSION['usertype'] == "staff" && $_SESSION['staff_type'] == "Faculty Incharge") {
                ?>
                    <li class="nav-item p-2"><a href="./admin.php">Home</a></li>
                    <li class="nav-item p-2"><a href="./event_approve.php">Approve Events</a></li>
                    <li class="nav-item p-2"><a href="./current.php">Current Events</a></li>
                    <li class="nav-item p-2"><a href="./past.php">Past Events</a></li>
                    <li class="nav-item p-2"><a href="./modify.php">Modify Members</a></li>
                    <li class="nav-item p-2"><a href="./login.php">Logout</a></li>
                <?php
                } elseif ($_SESSION['usertype'] == "staff" && ($_SESSION['staff_type'] == "HOD" || $_SESSION['staff_type'] == "Principal")) {
                ?>
                    <li class="nav-item p-2"><a href="./admin.php">Home</a></li>
                    <li class="nav-item p-2"><a href="./event_approve.php">Approve Events</a></li>
                    <li class="nav-item p-2"><a href="./current.php">Current Events</a></li>
                    <li class="nav-item p-2"><a href="./past.php">Past Events</a></li>
                    <li class="nav-item p-2"><a href="./login.php">Logout</a></li>
                <?php
                } elseif ($_SESSION['usertype'] == "staff" && $_SESSION['staff_type'] == "Super Admin") {
                ?>
                    <li class="nav-item p-2"><a href="./admin.php">Home</a></li>
                    <li class="nav-item p-2"><a href="./modify.php">Modify Members</a></li>
                    <li class="nav-item p-2"><a href="./current.php">Current Events</a></li>
                    <li class="nav-item p-2"><a href="./past.php">Past Events</a></li>
                    <li class="nav-item p-2"><a href="./login.php">Logout</a></li>
                <?php
                } else {
                ?>
                    <li class="nav-item p-2"><a href="./admin.php">Home</a></li>
                    <li class="nav-item p-2"><a href="./current.php">Current Events</a></li>
                    <li class="nav-item p-2"><a href="./past.php">Past Events</a></li>
                    <li class="nav-item p-2"><a href="./login.php">Logout</a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </nav >
            <?php
            if ($_SESSION['usertype'] == "staff" && ($_SESSION['staff_type'] == "Faculty Incharge" || $_SESSION['staff_type'] == "Super Admin")) {
                include "conn.php";
                $_SESSION['Council_name'] = "";
                $society_id = 0;
                $check2 = 0;
                $username = $_SESSION['username'];
                
                $res1 = mysqli_query($con, "SELECT * FROM `faculty_incharge` WHERE Fname = '$username'");
                while ($rows = $res1->fetch_assoc()) {
                    $society_id = $rows['Society_name'];
                    $res2 = mysqli_query($con, "SELECT * FROM `student_body` WHERE cid=$society_id");
                    $check2 = mysqli_num_rows($res2);
                }
                
                if ($check2 > 0) {
                    while ($rows = $res2->fetch_assoc()) {
                        $_SESSION['Council_name'] = $rows['Council_name'];
                        //$_SESSION['council_id']=$rows['cid'];
                    }
                }
                $counc = 0;
            ?> <?php
                function showtable($sid)
                {
                    include 'conn.php';
                    $res3 = mysqli_query($con, "SELECT * FROM `council_members` where Society=$sid");
        ?> <table id="table">
    <tr>
        <th>Fname</th>
        <th>Mname</th>
        <th>Lname</th>
        <th>Society</th>
        <th>Year</th>
        <th>Email</th>
    </tr>

    <?php
                    while ($rows3 = $res3->fetch_assoc()) {
    ?>
        <tr>
            <!--FETCHING DATA FROM EACH 
                            ROW OF EVERY COLUMN-->
            <td><?php echo $rows3['Fname']; ?></td>
            <td><?php echo $rows3['Mname']; ?></td>
            <td><?php echo $rows3['Lname']; ?></td>
            <td><?php echo $_SESSION['Council_name']; ?></td>
            <td><?php echo $rows3['Year']; ?></td>
            <td><?php echo $rows3['email']; ?></td>

        </tr>
    <?php
                    }
    ?>
    </table>
<?php
                }
                if ($_SESSION['usertype'] == "staff" && $_SESSION['staff_type'] == "Faculty Incharge") {
                    showtable($society_id);
                }
            }
            function showfactable($sid)
            {
                include 'conn.php';
                $res5 = mysqli_query($con, "SELECT * FROM `faculty_incharge` where Society_name=$sid");
?>
<table class="table" id="table" style="margin: 5% auto;width:80%">
    <tr>
        <th>Id</th>
        <th>Fname</th>
        <th>Mname</th>
        <th>Lname</th>
        <th>Society</th>
        <th>Email</th>
    </tr>
    <?php
                while ($rows3 = $res5->fetch_assoc()) {
                    $fac_id = $rows3['fid'];

    ?>

        <tr>
            <!--FETCHING DATA FROM EACH 
                        ROW OF EVERY COLUMN-->
            <td><?php echo $rows3['fid']; ?></td>
            <td><?php echo $rows3['Fname']; ?></td>
            <td><?php echo $rows3['Mname']; ?></td>
            <td><?php echo $rows3['Lname']; ?></td>
            <td><?php echo $_SESSION['Council_name']; ?></td>
            <td><?php echo $rows3['Email']; ?></td>

        </tr>
    <?php

                }
    ?>
</table>
<?php
            }
            if ($_SESSION['usertype'] == "staff" && ($_SESSION['staff_type'] == "Faculty Incharge" || $_SESSION['staff_type'] == "Super Admin")) {
?>
    <div class="container">
        <h3>Modify Members</h3>
        <form method="post" action="">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="name">First name:</label>
                    <input type="text" name="fname" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label for="name">Middle name:</label>
                    <input type="text" name="mname" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label for="name">Last name:</label>
                    <input type="text" name="lname" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="designation">Council Name</label>
                <select class="form-control" name="soc" id="soc" required>
                    <option class="paras">--Select Society-- </option>
                    <option value="1">1-ISA</option>
                    <option value="2">2-IEEE</option>
                    <option value="3">3-CSI</option>
                    <option value="4">4-ISTE</option>
                    <option value="5">5-Ecell</option>
                </select>
            </div>
            <div class="form-row ">
                <div class="form-group col-md-6">
                    <label for="name">Year(Only for Council Members)</label>
                    <input type="text" name="year" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="email-id">Email</label>
                    <input type="text" name="email-id" class="form-control" placeholder="abc@mail.com">
                </div>
            </div>

            <input type="submit" value="Modify/Add" name="modify" class="btn btn-primary" />
        </form>
    </div>
<?php
            }
            if ($_SESSION['usertype'] == "staff" &&  $_SESSION['staff_type'] == "Super Admin") {
?>
    <div class="selectbody" style="margin: 5% auto;width:80%">
        <h3>Select Student Body</h3>
        <form class="d-flex" method="post" action="">
            <button type="submit" class="custom-btn btn-14" name="isa" value="ISA">ISA </button>
            <button type="submit" class="custom-btn btn-14" name="ieee" value="IEEE">IEEE</button>
            <button type="submit" class="custom-btn btn-14" name="csi" value="CSI">CSI</button>
            <button type="submit" class="custom-btn btn-14" name="iste" value="ISTE">ISTE</button>
            <button type="submit" class="custom-btn btn-14" name="ecell" value="Ecell">Ecell</button>
        </form>
    </div>
    <div class="selectfaculty" style="margin: 5% auto;width:80%">
        <h3>Select Faculty Incharge</h3>
        <form class="d-flex" method="post" action="">
            <button type="submit" class="custom-btn btn-14" name="isafac" value="ISA">ISA</button>
            <button type="submit" class="custom-btn btn-14" name="ieeefac" value="IEEE">IEEE</button>
            <button type="submit" class="custom-btn btn-14" name="csifac" value="CSI">CSI</button>
            <button type="submit" class="custom-btn btn-14" name="istefac" value="ISTE">ISTE</button>
            <button type="submit" class="custom-btn btn-14" name="ecellfac" value="Ecell">Ecell</button>
        </form>
    </div>
<?php
            }
?>


<?php
if (isset($_POST['isa'])) {
    $society_id = 1;
    $_SESSION['Council_name'] = "ISA";
    showtable(1);
} elseif (isset($_POST['ieee'])) {
    $society_id = 2;
    $_SESSION['Council_name'] = "IEEE";
    showtable(2);
} elseif (isset($_POST['csi'])) {
    $society_id = 3;
    $_SESSION['Council_name'] = "CSI";
    showtable(3);
} elseif (isset($_POST['iste'])) {
    $society_id = 4;
    $_SESSION['Council_name'] = "ISTE";
    showtable(4);
} elseif (isset($_POST['ecell'])) {
    $society_id = 5;
    $_SESSION['Council_name'] = "Ecell";
    showtable(5);
}

if (isset($_POST['isafac'])) {
    $society_id = 1;
    $_SESSION['Council_name'] = "ISA";
    showfactable(1);
} elseif (isset($_POST['ieeefac'])) {
    $society_id = 2;
    $_SESSION['Council_name'] = "IEEE";
    showfactable(2);
} elseif (isset($_POST['csifac'])) {
    $society_id = 3;
    $_SESSION['Council_name'] = "CSI";
    showfactable(3);
} elseif (isset($_POST['istefac'])) {
    $society_id = 4;
    $_SESSION['Council_name'] = "ISTE";
    showfactable(4);
} elseif (isset($_POST['ecellfac'])) {
    $society_id = 5;
    $_SESSION['Council_name'] = "Ecell";
    showfactable(5);
}


?>

<footer class="footer-section">
        <div class="footer-container">
            <div class="footer-cta pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fa fa-map-marker"></i>
                            <div class="cta-text">
                                <h4>Address</h4>
                                <span>Hashu Advani Memorial Complex, Collector’s Colony, Chembur, Mumbai – 400 074. India.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fa fa-phone"></i>
                            <div class="cta-text">
                                <h4>Call us</h4>
                                <span>+91-22-61532510</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fa fa-envelope"></i>
                            <div class="cta-text">
                                <h4>Mail us</h4>
                                <span>vesit.admission@ves.ac.in</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-content pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 mb-50">
                        <div class="footer-widget">
                            <div class="footer-logo">
                                <img src="./Veslogo.jpeg" class="img-fluid" alt="logo">
                            </div>
                            <div class="footer-text">
                                <p>Arise, awake, stop not till the goal is reached</p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Useful Links</h3>
                            </div>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Current Events</a></li>
                                <li><a href="#">Past Events</a></li>
                                <li><a href="#">Logout</a></li>
                            </ul>
                        </div>
                        
                    </div>
                    <div class="footer-social-icon col-xl-4 col-lg-4 col-md-6 mb-50">
                                <span>Follow us</span>
                                <a href="https://www.facebook.com/vesitedu/"><i class="fa fa-facebook-f facebook-bg"></i></a>
                                <a href="https://twitter.com/vesitedu"><i class="fa fa-twitter twitter-bg"></i></a>
                                <a href="https://www.instagram.com/vesitedu/"><i class="fa fa-instagram instagram-bg"></i></a>
                                <a href=""><i class="fa fa-linkedin linkedin-bg"></i></a>

                        </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href)
    }
</script>

<?php
$msg = "";
if (isset($_POST['modify'])) {
    $fid = 0;
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $email = $_POST['email-id'];
    $year = $_POST['year'];
    // $password = $_POST['password'];
    $soc = $_POST['soc'];
    //   echo $soc;
    //  echo $year;
    include 'conn.php';
    if ($year == "") {
        $res1 = mysqli_query($con, "SELECT * FROM `faculty_incharge` WHERE `Email`='$email'");
        $check = mysqli_num_rows($res1);
        if ($check > 0) {
            while ($rows6 = $res1->fetch_assoc()) {
                $fid = $rows6['fid'];
            }
            $res = mysqli_query($con, "UPDATE `faculty_incharge` SET `Fname`='$fname',`Mname`='$mname',`Lname`='$lname',`Email`='$email',`Society_name`=$soc WHERE `fid`=$fid");
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Updated!!",
                })
                </script>';
        } else {
            $res2 = mysqli_query($con, "INSERT INTO `faculty_incharge`( `Fname`, `Mname`, `Lname`, `Email`, `Society_name`) VALUES ('$fname','$mname','$lname','$email',$fid)");
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Added!!",
                })
                </script>';
        }
    } else {
        $cid = 0;
        $res1 = mysqli_query($con, "SELECT * FROM `council_members` WHERE `Email`='$email'");
        $check = mysqli_num_rows($res1);
        if ($check > 0) {
            while ($rows6 = $res1->fetch_assoc()) {
                $cid = $rows6['council_id'];
            }
            $res = mysqli_query($con, "UPDATE `council_members` SET `Fname`='$fname',`Mname`='$mname',`Lname`='$lname',`Email`='$email',`Society`=$soc,`Year`='$year' WHERE `council_id`=$cid");
            echo "done";
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Updated!!",
                })
                </script>';
        } else {
            $res2 = mysqli_query($con, "INSERT INTO `council_members`( `Society`, `Year`, `Fname`, `Mname`, `Lname`, `email`) VALUES ($soc,'$year','$fname','$mname','$lname','$email')");
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Added!!",
                })
                </script>';
        }
    }
}

?>