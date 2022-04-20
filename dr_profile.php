<?php
session_start();
include("connection.php");
include("functions.php");
$query="select * from approved where id='$_SESSION[target]'";
$result = mysqli_query($con,$query);
$data = mysqli_fetch_array($result);
//$data= $_SESSION['super'];


if (isset($_POST['info']))
{
    $info= $_POST['textarea'];
    $update="UPDATE approved SET info='$info' WHERE username='$data[username]'";
    mysqli_query($con,$update);
    header("Location: profile.php");
    die;
}
?>
<!DOCTYPE html>
<html>
<title>Profile</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
    html,
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: "Roboto", sans-serif
    }
    
    #map {
        margin-bottom: -8px;
        padding-bottom: 40px;
        overflow: hidden;
        border-top-left-radius: 7px;
        border-bottom-left-radius: 7px;
    }
</style>

<body class="w3-light-grey">

    <!-- Page Container -->
    <div class="w3-content w3-margin-top" style="max-width:1400px;">

        <!-- The Grid -->
        <div class="w3-row-padding">

            <!-- Left Column -->
            <div class="w3-third">

                <div class="w3-white w3-text-grey w3-card-4">
                    <div class="w3-display-container">
                        <img src="uploads/photos/<?php echo $data['profilepic'];?>" style="width:100%" alt="Avatar">
                        <div class="w3-display-bottomleft w3-container w3-text-black">
                            <h2><?php echo $data['fname'];?> <?php echo $data['lname'];?></h2>
                        </div>
                    </div>
                    <div class="w3-container">
                        <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $data['specialty'];?></p>
                        <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $data['location'];?></p>
                        <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $data['email'];?></p>
                        <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $data['phone'];?></p>
                        <hr>



                    </div>
                </div><br>

                <!-- End Left Column -->
            </div>

            <!-- Right Column -->
            <div class="w3-twothird">

                <div class="w3-container w3-card w3-white w3-margin-bottom">
                    <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Doctor's info</h2>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><b><?php echo $data['fname'];?>&nbsp;<?php echo $data['lname'];?></b></h5>
                        <h6 class="w3-text-teal"><?php echo $data['specialty'];?> - <span class="w3-tag w3-teal w3-round">Specialty</span></h6>
                        <?php 
                        if ($data['info'] == NULL)
                        { ?>
                        <br>
                        <p style="color: red;">This doctor has no avaliable info yet</p>                   
                        <?php
                        }
                        else{
                        ?>
                        <p><?php echo $data['info'];?></p>
                        <br>
                        
                        <?php } ?>
                        <hr>
                    </div>
                    
                </div>

                <div class="w3-container w3-card w3-white">
                    <h2 class="w3-text-grey w3-padding-16"></i>Location on the map</h2>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><b>This is where <?php echo $data['fname'];?> is on the map</b></h5>
                        <hr>
                        </div>
                    <div  id="map">
                        <br>
                        <?php echo $data['locationlink'];?>
                    </div>
                </div>

                <!-- End Right Column -->
            </div>

            <!-- End Grid -->
        </div>

        <!-- End Page Container -->
    </div>

    <footer class="w3-container w3-teal w3-center w3-margin-top">
        <br><br><br>

    </footer>

</body>

</html>