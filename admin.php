<?php
session_start();
include("connection.php");
include("functions.php");
$check= check_login_admin($con);

if (isset($_POST['user']))
{
    $username= $_POST['username'];
    $sql_u = "SELECT * FROM approved WHERE username='$username'";

    $res_u = mysqli_query($con, $sql_u);
    if (mysqli_num_rows($res_u) < 1) {
        $name_error = "Sorry... The username does not exist"; 	
    }
    else{    
    $delete="delete from approved where username='$username'";
    mysqli_query($con,$delete);
    ?>
    <script>
        alert("User was deleted successfully");
    </script>
    <?php
    header("Location: admin.php");
    die;
    
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin's page</title>

    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <style>
        form.example input[type=text] {
        padding: 10px;
        font-size: 17px;
        border: 1px solid grey;
        float: left;
        width: 80%;
        background: #f1f1f1;
        }

        form.example button {
        float: left;
        padding: 10px;
        background: #818181;
        color: white;
        font-size: 17px;
        border: 1px solid grey;
        border-left: none;
        cursor: pointer;
        }

        form.example button:hover {
        background: #da1313;
        }

        form.example::after {
        content: "";
        clear: both;
        display: table;
        }
    </style>

	<!--===============================================================================================-->	
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
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
		<link rel="stylesheet" type="text/css" href="assets/css/signup.css">
	<!--===============================================================================================-->
    
</head>
<body>

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

<h3 style="padding-top: 100px; text-align: center;">Delete from already approved doctors</h3>
<form method="post" action="admin.php" class="example" style="padding-top: 10px; margin:auto;max-width:300px">
  <input type="text" placeholder="Username.." name="username">
  <button name="user">Delete doctor</button>
  <br><br><br><br>
  <?php if (isset($name_error)): ?>
	  	        <span style="text-align: center; color: red;"><?php echo $name_error; ?></span> <br><br>
	            <?php endif ?>
</form>



        <?php
        $query="select * from doctors";

        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0){
        ?>
        <ul class="user-profiles-list-basic">
        <?php    
        while($data = mysqli_fetch_array($result))
        {   
            ?>
            <li>

                <a href="#" class="user-avatar">
                    <img src="uploads/photos/<?php echo $data['profilepic']; ?>" width="80" alt="Profile picture" />
                </a>

                <p>
                    <a href=""><?php echo $data['fname'];?> <?php echo $data['lname'];?></a>
                    <span>Specialty: &nbsp; <?php echo $data['specialty'];?>&nbsp;&nbsp;&nbsp; id: <?php echo $data['id']; ?>  &nbsp;&nbsp;&nbsp;  Username:  <?php echo $data['username']; ?></span>
                </p>
                <form action="admin.php" method="post">
                <input type="hidden" name='data' value="<?php echo $data['id'];?>">
                <button name="delete" class="delete">Delete</button>
                </form>
                <form action="admin.php" method="post">
                <input type="hidden" name='id' value="<?php echo $data['id'];?>">
                <input type="hidden" name='doctor_id' value="<?php echo $data['doctor_id'];?>">
                <input type="hidden" name='email' value="<?php echo $data['email'];?>">
                <input type="hidden" name='password' value="<?php echo $data['password'];?>">
                <input type="hidden" name='username' value="<?php echo $data['username'];?>">
                <input type="hidden" name='fname' value="<?php echo $data['fname'];?>">
                <input type="hidden" name='lname' value="<?php echo $data['lname'];?>">
                <input type="hidden" name='gender' value="<?php echo $data['gender'];?>">
                <input type="hidden" name='specialty' value="<?php echo $data['specialty'];?>">
                <input type="hidden" name='phone' value="<?php echo $data['phone'];?>">               
                <input type="hidden" name='location' value="<?php echo $data['location'];?>">
                <input type="hidden" name='file' value="<?php echo $data['file'];?>">
                <input type="hidden" name='profilepic' value="<?php echo $data['profilepic'];?>">
                <button name="approve" class="approve">Approve</button>
                </form>
                
                <a href="uploads/files/<?php echo"$data[file]"; ?>" download name="download" class="download">Download</a>
                
            </li>
            
            <?php

            if (isset($_POST['delete']))
            {
                $delete="delete from doctors where id='$_POST[data]'";
                mysqli_query($con,$delete);
                echo"<script>window.location.href='admin.php';</script>";
                die;
            }

            if (isset($_POST['approve']))
            {
                $delete="DELETE FROM doctors WHERE id='$_POST[id]' limit 1";
                $approve= "insert into approved (id,doctor_id,email,password,username,fname,lname,gender,specialty,phone,locationlink,location,file,profilepic) values ('$_POST[id]','$_POST[doctor_id]','$_POST[email]','$_POST[password]','$_POST[username]','$_POST[fname]','$_POST[lname]','$_POST[gender]','$_POST[specialty]','$_POST[phone]','$data[locationlink]','$_POST[location]','$_POST[file]','$_POST[profilepic]')";
                mysqli_query($con,$approve);
                mysqli_query($con,$delete);
                echo"<script>window.location.href='admin.php';</script>";
                die;
            }
        }}
        else{
            ?>
            <h1 style="padding-top: 120px; text-align: center;">There are no sign up requests now</h1>


            <?php
            }
        ?>
    </ul>

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