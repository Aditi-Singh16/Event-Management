<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="modify.css">
    <title>Approve Events</title>
    <style>
        body{
            overflow-x: hidden;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        .table button{
            background-color: aqua;
            outline: none;
        }
        tr:nth-child(even) {
            background-color: #add8e6;
        }

    </style>
</head>
<body>
    <script src="https://kit.fontawesome.com/14f5cf4f5a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.14.0/dist/sweetalert2.all.min.js"></script>
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
                if($_SESSION['usertype']=="staff" && $_SESSION['staff_type']=="Faculty Incharge" ){
            ?>
                <li  class="nav-item p-2"><a href="./admin.php">Home</a></li>
                <li  class="nav-item p-2"><a href="./event_approve.php">Approve Events</a></li>
                <li  class="nav-item p-2"><a href="./current.php">Current Events</a></li>
                <li  class="nav-item p-2"><a href="./past.php">Past Events</a></li>
                <li  class="nav-item p-2"><a href="./modify.php">Modify Members</a></li>
                <li  class="nav-item p-2"><a href="./login.php">Logout</a></li>
            <?php
                }elseif ($_SESSION['usertype']=="staff" && ($_SESSION['staff_type']=="HOD" || $_SESSION['staff_type']=="Principal")) {
            ?>
                <li  class="nav-item p-2"><a href="./admin.php">Home</a></li>
                <li  class="nav-item p-2"><a href="./event_approve.php">Approve Events</a></li>
                <li  class="nav-item p-2"><a href="./current.php">Current Events</a></li>
                <li  class="nav-item p-2"><a href="./past.php">Past Events</a></li>
                <li  class="nav-item p-2"><a href="./login.php">Logout</a></li>
                <?php
                }elseif ($_SESSION['usertype']=="staff" && $_SESSION['staff_type']=="Super Admin" ) {
            ?>
                <li  class="nav-item p-2"><a href="./admin.php">Home</a></li>
                <li  class="nav-item p-2"><a href="./modify.php">Modify Members</a></li>
                <li  class="nav-item p-2"><a href="./current.php">Current Events</a></li>
                <li  class="nav-item p-2"><a href="./past.php">Past Events</a></li>
                <li  class="nav-item p-2"><a href="./login.php">Logout</a></li>
            <?php
                }else{
            ?>
                <li  class="nav-item p-2"><a href="./admin.php">Home</a></li>
                <li class="nav-item p-2"><a href="./current.php">Current Events</a></li>
                <li class="nav-item p-2"><a href="./past.php">Past Events</a></li>
                <li class="nav-item p-2"><a href="./login.php">Logout</a></li>
            <?php
                }
            ?>
            </ul>
        </div>
    </nav>
    <table class="table" id="table" style="margin: 5% auto">
        <tr>
            <th>Id</th>
            <th>Event Name</th>
            <th>Description</th>
            <th>Level</th>             
            <th>Start date</th>
            <th>End date</th>
            <th>Approve</th>    
        </tr>
    <?php
        include 'conn.php';
        $society_id = 0;
        $event_id=0;
        $username = $_SESSION['username'];
        $res1=mysqli_query($con,"SELECT * FROM `faculty_incharge` WHERE Fname = '$username'");
        while($rows=$res1->fetch_assoc()){
            $society_id = $rows['Society_name'];
            $res2=mysqli_query($con,"SELECT * FROM `student_body` WHERE cid=$society_id");
            $check2=mysqli_num_rows($res2);
        }
        if($_SESSION['usertype']=="staff" && $_SESSION['staff_type']=="Faculty Incharge" ){
            $res=mysqli_query($con,"SELECT * FROM `events` WHERE Council_id=$society_id AND `Status`='Pending'");
            while($rows3=$res->fetch_assoc()){
                $event_id = $rows3['event_id'];
    ?>
        <tr>
            <form method="post" action="">

            <td><?php echo $rows3['event_id'];?></td>
            <td><?php echo $rows3['Event_name'];?></td>
            <td><?php echo $rows3['Description'];?></td>
            <td><?php echo $rows3['Level'];?></td>
            <td><?php echo $rows3['Start_date'];?></td>
            <td><?php echo $rows3['End_date'];?></td>
            <td><input type="submit" name="approve" value="Approve"></td>
            </form>
        </tr>
    <?php
            }
            
        }
        elseif ($_SESSION['usertype']=="staff" && $_SESSION['staff_type']=="Principal" ) {
            $res=mysqli_query($con,"SELECT * FROM `events` WHERE `Level`='Institute' AND `Status`='Pending'");
            while($rows3=$res->fetch_assoc()){
                $event_id = $rows3['event_id'];
    ?>  
        <tr>
            <form method="post" action="">
            <td><?php echo $rows3['event_id'];?></td>
            <td><?php echo $rows3['Event_name'];?></td>
            <td><?php echo $rows3['Description'];?></td>
            <td><?php echo $rows3['Level'];?></td>
            <td><?php echo $rows3['Start_date'];?></td>
            <td><?php echo $rows3['End_date'];?></td>
            <td><input type="submit" name="approvePrin" value="Approve"></td>
            </form>
        </tr>
    <?php
        }
            
    }
        elseif ($_SESSION['usertype']=="staff" && $_SESSION['staff_type']=="HOD" ) {
            $res=mysqli_query($con,"SELECT * FROM `events` WHERE `Level`='Department' AND `Status`='Pending'");
            while($rows3=$res->fetch_assoc()){
                $event_id = $rows3['event_id'];
    ?>  
        <tr>
            <form method="post" action="">
            <td><?php echo $rows3['event_id'];?></td>
            <td><?php echo $rows3['Event_name'];?></td>
            <td><?php echo $rows3['Description'];?></td>
            <td><?php echo $rows3['Level'];?></td>
            <td><?php echo $rows3['Start_date'];?></td>
            <td><?php echo $rows3['End_date'];?></td>
            <td><input type="submit" name="approveHod" value="Approve"></td>
            </form>
        </tr>
    <?php
        }
            
    }
    ?>
    </table>
    
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
<?php
    if (isset($_POST['approve'])) {
        echo "äpprove";
        include 'conn.php';
        $res4=mysqli_query($con,"UPDATE `events` SET `Status`='Yes' WHERE `event_id`=$event_id");
        echo '<script>
          Swal.fire({
            icon: "success",
            title: "Event Approved",
          })
        </script>';
    }
    if (isset($_POST['approvePrin'])) {
        echo "äpprove";
        include 'conn.php';
        $res4=mysqli_query($con,"UPDATE `events` SET `Status`='Yes' WHERE `event_id`=$event_id");
        echo '<script>
          Swal.fire({
            icon: "success",
            title: "Event Approved",
          })
        </script>';
    }
    if (isset($_POST['approveHod'])) {
        echo "äpprove";
        include 'conn.php';
        $res4=mysqli_query($con,"UPDATE `events` SET `Status`='Yes' WHERE `event_id`=$event_id");
        echo '<script>
          Swal.fire({
            icon: "success",
            title: "Event Approved",
          })
        </script>';
    }
?>
<script>
    if(window.history.replaceState){
        window.history.replaceState( null, null, window.location.href )
    }
</script>