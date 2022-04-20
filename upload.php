<?php

include("connection.php");
include("functions.php");


if (isset($_POST['submit'])) { 
    
    $username= $_POST['username'];
    $email= $_POST['email'];

    $sql_u = "SELECT * FROM approved WHERE username='$username'";
    $sql_e = "SELECT * FROM approved WHERE email='$email'";

    $res_u = mysqli_query($con, $sql_u);
    $res_e = mysqli_query($con, $sql_e);

    if (mysqli_num_rows($res_u) > 0) {
        $name_error = "Sorry... username already taken"; 	
    }else if(mysqli_num_rows($res_e) > 0){
        $email_error = "Sorry... email already taken";
    }
    else{
    
    $file = $_FILES['file'];
    $fileName= $_FILES['file']['name'];
    $fileTmpName= $_FILES['file']['tmp_name'];
    $fileSize= $_FILES['file']['size'];
    $fileError= $_FILES['file']['error'];
    $fileType= $_FILES['file']['type'];

    $fileExt=explode('.',$fileName);
    $fileActualExt= strtolower(end($fileExt));
    $fileNameNew= uniqid('',true).".".$fileActualExt;

    $fileDestination = 'uploads/files/'.$fileNameNew;
    move_uploaded_file($fileTmpName,$fileDestination);

    $photo = $_FILES['photo'];
    $photoName= $_FILES['photo']['name'];
    $photoTmpName= $_FILES['photo']['tmp_name'];
    $photoSize= $_FILES['photo']['size'];
    $photoError= $_FILES['photo']['error'];
    $photoType= $_FILES['photo']['type'];

    $photoExt=explode('.',$photoName);
    $photoActualExt= strtolower(end($photoExt));
    $photoNameNew= uniqid('',true).".".$photoActualExt;

    $photoDestination = 'uploads/photos/'.$photoNameNew;
    move_uploaded_file($photoTmpName,$photoDestination);


    $email= $_POST['email'];
	$password= $_POST['password'];
    $username= $_POST['username'];
	$fname= $_POST['fname'];
	$lname= $_POST['lname'];
    $gender=$_POST['gender'];
    $specialty=$_POST['specialty'];
    $phoneNumber=$_POST['phonenumber'];
    $locationLink=$_POST['locationlink'];
    $location=$_POST['location'];



    if(!empty($email)&&!empty($password)&&!empty($fname)&&!empty($lname)&&!empty($gender)&&!empty($specialty)&&!empty($phoneNumber)&&!empty($locationLink)&&!empty($location))
    {
        //save to database
        $doctorid= random_num(20);
        $query="insert into doctors (doctor_id,email,password,username,fname,lname,gender,specialty,phone,locationlink,location,file,profilepic) values ('$doctorid','$email','$password','$username','$fname','$lname','$gender','$specialty','$phoneNumber','$locationLink','$location','$fileNameNew','$photoNameNew')";

        mysqli_query($con,$query);
        $done="done";
        header("Location: index.php");
        die;

    }
    else
    {
        echo "please inter valid data";
    }
    


    
    
    echo'done';
    }
}