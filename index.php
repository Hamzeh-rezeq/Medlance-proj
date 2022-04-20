<?php
session_start();
include("connection.php");
include("functions.php");
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Home page</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-plot-listing.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="index.php" class="active">Home</a></li>
                            <li>
                            <?php
                             // check if this user is a doctor
                             if(isset($_SESSION['user_id']))
                             {
                              $id= $_SESSION['user_id'];
                              $query= "select * from approved where doctor_id  = '$id' limit 1";
                          
                              $result= mysqli_query($con,$query);
                              if($result && mysqli_num_rows($result) > 0)
                              {
                            ?>
                                <a href="profile.php">My profile
                            <?php } else{
                                // check if this user is a patient
                                 $query= "select * from patients where user_id  = '$id' limit 1";

                                 $result= mysqli_query($con,$query);
                                 if($result && mysqli_num_rows($result) > 0)
                                 {
                                    // check if this user is the admin
                                    $user_data =mysqli_fetch_assoc($result);
                                    $username=$user_data['username'];
                                    if($username==='admin')
                                    { ?>
                                    <a href="admin.php">Admin portal
                                    <?php
                                    }else{
                                 ?>
                                    <a href="#">My favorites
                                 <?php }}else{ } } }
                                 else{
                                ?>
                                <a href="dr_Signup.php">are you a doctor?
                                <?php }?>
                            </a></li>
                            <?php
                                if(isset($_SESSION['user_id'])){
                                    ?>
                            <li>                                       
                                <div class="main-white-button"><a href="logout.php">Log out</a></div>              
                            </li>
                            <?php } 
                            else{
                            ?>
                            <li>                                            
                                <div class="main-white-button"><a href="login.php">Log in</a></div>              
                            </li>
                            <?php } ?>

                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->


    <div class="main-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="top-text header-text">
                        <h4>Medlance .. Medical freelances</h4>
                        <h2>Find Nearby Doctors &amp; Clinics</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form id="search-form" name="gs" method="POST" role="search" action="results.php" >
                        <div class="row">
                            <div class="col-lg-3 align-self-center">
                                <fieldset>
                                    <select name="location" class="form-select" aria-label="Area" id="chooseCategory" onchange="this.form.click()">
                                    <option selected>All Areas</option>
                                    <option value="Amman">Amman</option>
                                    <option value="Zarqa">Zarqa</option>
                                    <option value="Irbid">Irbid</option>
                                    <option value="Russeifa">Russeifa</option>
                                    <option value="Aqaba">Aqaba</option>
                                    <option value="Madaba">Madaba</option>
                                    <option value="As-Salt">As-Salt</option>
                                    <option value="Karak">Karak</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-3 align-self-center">
                                <fieldset>
                                    <input type="address" name="name" class="searchText" placeholder="Search by name" autocomplete="on" >
                                </fieldset>
                            </div>
                            <div class="col-lg-3 align-self-center">
                                <fieldset>
                                   
                                    <input placeholder="Specialty" type="search" list="Select_Specialty" name="specialty" class="form-select" aria-label="Default select example" id="chooseCategory" onchange="this.form.click()">
                <datalist id="Select_Specialty">
                    <option value="Specialty#1"/>
                    <option value="Specialty#2"/>
                    <option value="Specialty#3"/>
                    <option value="Specialty#4"/>
                    <option value="Specialty#5"/>
                    <option value="Specialty#6"/>
                    <option value="Specialty#7"/>
                    <option value="Specialty#8"/>


                </datalist>
                      </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-3">
                                <fieldset>
                                    <button class="main-button"><i class="fa fa-search"></i> Search Now</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="about">
                        <div class="logo">
                            <img src="assets/images/black_logo-removebg2.png" alt="Plot Listing">
                        </div>
                        <p>Medical freelances, where you get to know the doctors near your location.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="helpful-links">
                        <h4>Helpful Links</h4>
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <ul>
                                    <li><a href="login.php">Log in</a></li>
                                    <li><a href="signup.php">Sign up</a></li>
                                    <li><a href="dr_Signup.php">Sign up for doctors</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-us">
                        <h4>Contact Us</h4>
                        <p>This project was done by Sofian and Hamzah</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <p>Sofian: sofian.alfaqieh@gmail.com</p>
                            </div>
                            <div class="col-lg-6">
                            <p>Hamzeh: hamzeh.rezeq00@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="sub-footer">
                        <p>The World Islamic Sciences & Education University</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/animation.js"></script>
    <script src="assets/js/imagesloaded.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>