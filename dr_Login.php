<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD']== "POST")
{
	//something was posted
	$username= $_POST['username'];
	$password= $_POST['password'];
	

	if(($username)&&!empty($password))
{
	//read from the database
	$query="select * from approved where username = '$username' limit 1";

	$result = mysqli_query($con,$query);
    
    if($result && mysqli_num_rows($result) > 0)
    {
        $user_data =mysqli_fetch_assoc($result);
        
        if($user_data['password']===$password)
        {
            $_SESSION['user_id'] = $user_data['doctor_id'];
            header("Location: index.php");
            die;
        }
    }else
    {
        $error = "Wrong username or password";
    }

}
else
{
	die("please enter valid data");
}

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor Log In</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <!--===============================================================================================-->

</head>

<body style="background-color: #666666;">


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-in-login">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">
                        </a>
                        <!-- ***** Logo End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form action="dr_Login.php" method="POST" class="login100-form validate-form">
                    <span class="login100-form-title p-b-43">
						Login to continue
					</span>

                    
                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <input class="input100" type="text" name="username">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Username</span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>

                    <?php if (isset($error)): ?>
                    <span style="color: red;"><?php echo $error; ?></span><br><br>
                    <?php endif ?>
                    

                    <div class="container-login100-form-btn">
                        <button type="submit" value="login" class="login100-form-btn">
							Login
						</button>
                    </div>
                    
                    <div class="text-center p-t-46 p-b-20">
                        <span class="txt2">
							First time using Medlance ?

							<a href="dr_Signup.php">Sign up</a>
							
						</span>
                    </div>
                </form>

                <div class="login100-more" style="background-image: url('assets/images/home_page_background.jpg');">
                </div>
            </div>
        </div>
    </div>





    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="assets/js/login.js"></script>

</body>

</html>