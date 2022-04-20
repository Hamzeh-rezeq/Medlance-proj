<?php
session_start();
include("connection.php");
include("functions.php");
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Results page</title>

    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets\css\filterbar.css">
       <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-plot-listing.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">

</head>
<body>
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
    
    <ul style="padding-top: 150px;" class="user-profiles-list-basic">


        <?php
        if($_SERVER['REQUEST_METHOD']== "POST")
        {
            $location= $_POST['location'];
            $name= $_POST['name'];
            $specialty= $_POST['specialty'];

            if(($specialty=='')&&($location=='All Areas')&&!($name=='')){
            $query="select * from approved where (fname='$name') or (location='$location') or (specialty='$specialty') ";//if user only inputed a name 
            $result = mysqli_query($con,$query);}
            else if(!($specialty=='')&&($location=='All Areas')&&!($name=='')){
                $query="select * from approved where (fname='$name') and (specialty='$specialty') or (location='$location') ";//if user only inputed specialty and a name
                $result = mysqli_query($con,$query);

            }
            else if(($specialty=='')&&!($location=='All Areas')&&!($name=='')){
                $query="select * from approved where (fname='$name') and (location='$location') or (specialty='$specialty') ";//if user only inputed a location and name
                $result = mysqli_query($con,$query);

            }else if(!($specialty=='')&&!($location=='All Areas')&&!($name=='')){
                $query="select * from approved where (fname='$name') and (location='$location') and (specialty='$specialty') ";//if user inputed all field
                $result = mysqli_query($con,$query);
            }else if($name==''&&!($specialty=='')&&!($location=='All Areas')){
                $query="select * from approved where (location='$location') and (specialty='$specialty') or (fname='$name') ";//if user only inputed location and specialty
                $result = mysqli_query($con,$query);

            }else if($name==''&&($specialty=='')&&!($location=='All Areas')){
                $query="select * from approved where (location='$location') or (specialty='$specialty') or (fname='$name') ";//if user only inputed only location
                $result = mysqli_query($con,$query);
            }else if($name==''&&!($specialty=='')&&($location=='All Areas')){
                $query="select * from approved where (specialty='$specialty') or (location='$location') or (fname='$name') ";//if user only inputed only specialty
                $result = mysqli_query($con,$query);
            }else if(!($location=='')){
                $query="select * from approved";//if User only inputed All Areas
                $result = mysqli_query($con,$query);
            }

            if($result && mysqli_num_rows($result) > 0)
            {   
                
                
                while($data = mysqli_fetch_array($result))
                {  
                ?>
                <li>
                    
                    <a  class="user-avatar">
                        <img src="uploads/photos/<?php echo $data['profilepic']; ?>" width="80" alt="Profile picture" />
                    </a>

                    <p>
                    <a><?php echo $data['fname'];?> <?php echo $data['lname'];?></a>
                    <span>Specialty: &nbsp; <?php echo $data['specialty'];?>&nbsp;&nbsp;&nbsp; Location: <?php echo $data['location']; ?> </span>
                    </p>
                    <form name="select"  method="post">
                    <input type="hidden" name='data' value="<?php echo $data['id'];?>">
                    <button name="view" class="approve">View</button>
                    </form>
                </li>
                
                <?php
                }
            }
            else
            {
                echo"empty  , $location, $name, $specialty";
            }
    }   
        else
        {
            echo"error";
        }
        if (isset($_POST['view']))
            {
                $_SESSION['target']=$_POST['data'];
                header("Location: dr_profile.php");
                die;
                
            }
        ?>
        
    </ul>
    

    
</body>

</html>