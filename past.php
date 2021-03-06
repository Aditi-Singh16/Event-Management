<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="past.css">
    <link rel="stylesheet" href="footer.css">
    <title>Past Events</title>
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
                } elseif ($_SESSION['usertype'] == "studentbody") {
                ?>
                    <li class="nav-item p-2"><a href="./admin.php">Home</a></li>
                    <li class="nav-item p-2"><a href="./event_register.php">Register Event</a></li>
                    <li class="nav-item p-2"><a href="./profile.php">Profile</a></li>
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
    <!--Past Events-->
    <center>
    <h2 class="title">Past Events</h2>

    <?php
      include 'conn.php';
  
      // Checking for connections
      if (!$con){
          die("Sorry we failed to connect: ". mysqli_connect_error());
      }else{
  
          $sql = "SELECT * FROM `events` WHERE  (SELECT CURDATE()) > `End_date` AND `Status` = 'Yes'" ;
          $result =$con->query($sql);
          while ($rows = $result -> fetch_assoc()) {
            
          ?>      
   
    <div class="card event" style="width: 38rem;">
  <div class="card-body">
    
    <h4 class="card-title"><?php echo $rows["Event_name"] ;?></h4>
    <p class="card-text"><?php echo $rows["Description"];?></p>

  </div>
</div>
<?php 
          }
        }
        $con->close()
?>    
    
   
    <!-- <div class="card event" style="width: 38rem;">
  <div class="card-body">
    <h4 class="card-title">Image Processing</h4>
    <p class="card-text">Ever wondered how the Instagram's amazing filters work or how to convert a degraded image into an enhanced and clear image? The answer is IMAGE PROCESSING! ISA-VESIT presents to you a golden opportunity to learn image processing and understand it's vivid applications.</p>
  
  </div>
</div>

<div class="card event" style="width: 38rem;">
  <div class="card-body">
    <h4 class="card-title">3D Animation</h4>
    <p class="card-text">Ever thought even you can fulfill your dream of "enjoy-as-you-work" and feel satisfied by your work at the end of the day!!
Even you could be the chef d'oeuvre of the virtual three dimensional world!! ISA-VESIT has got your back. We are thrilled to put forth our upcoming workshop on 3D Animation using Three.js</p>
  
  </div>
</div>

   

<div class="card event" style="width: 38rem;">
  <div class="card-body">
    <h4 class="card-title">Blockchain Technology</h4>
    <p class="card-text">Blockchain Technology is taking over the world with its top security, faster transaction speed and full transparency. IEEE-VESIT presents you, for the first time ever, a workshop on Blockchain with no prerequisites.</p>
 
  </div>
</div>
     -->
</center>
<br><br><br>
<footer class="footer-section">
        <div class="footer-container">
            <div class="footer-cta pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fa fa-map-marker"></i>
                            <div class="cta-text">
                                <h4>Address</h4>
                                <span>Hashu Advani Memorial Complex, Collector???s Colony, Chembur, Mumbai ??? 400 074. India.</span>
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