<?php

function check_login_doctor($con)
{
   if(isset($_SESSION['user_id']))
   {
    $id= $_SESSION['user_id'];
    $query= "select * from approved where doctor_id  = '$id' limit 1";

    $result= mysqli_query($con,$query);
    if($result && mysqli_num_rows($result) > 0)
    {
        $user_data =mysqli_fetch_assoc($result);
        return $user_data;
    }
   }
   else
   {
    //redirect to login
    header("Location: dr_Login.php");
    die;
   }
}


function check_login_patient($con)
{
   if(isset($_SESSION['user_id']))
   {
    $id= $_SESSION['user_id'];
    $query= "select * from patients where user_id  = '$id' limit 1";

    $result= mysqli_query($con,$query);
    if($result && mysqli_num_rows($result) > 0)
    {
        $user_data =mysqli_fetch_assoc($result);
        return $user_data;
    }
   }
//redirect to login
header("Location: login.php");
die;

}

function check_login_admin($con)
{
    if(isset($_SESSION['user_id']))
    {
     $id= $_SESSION['user_id'];
     $query= "select * from patients where user_id  = '$id' limit 1";
 
     $result= mysqli_query($con,$query);
     if($result && mysqli_num_rows($result) > 0)
     {
        $user_data =mysqli_fetch_assoc($result);
        $username=$user_data['username'];
        if($username==='admin')
        {
            return $user_data;
        }
        else{   
            //redirect to login
            header("Location: login.php");
            die;
            }
     }
    }
 //redirect to login
 header("Location: login.php");
 die;

}


function random_num($length)
{
    $text="";
    if($length<5)
    {
        $length=5;
    }

    $len = rand(4,$length);

    for($i=0;$i<$len;$i++)
    {
        $text .=rand(0,9);

    }
    return $text;
}
