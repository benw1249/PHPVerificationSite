<?php
session_start();
include 'connect.php';

if(isset($_REQUEST['name']) && isset($_REQUEST['password'])){

    $name=mysqli_real_escape_string($con,$_REQUEST['name']);
    $password=mysqli_real_escape_string($con,$_REQUEST['password']);
    $qr=mysqli_query($con,"select * from users where name='".$name."' and password='".md5($password)."'");
    if(mysqli_num_rows($qr)>0){
        $data=mysqli_fetch_assoc($qr);
        $_SESSION['user_data']=$data;
        if($data['usertype']==1){
            header("Location:teacher_home.php");
        }
        else{
            header("Location:student_home.php");
        }

    }
    else{
        header("Location:index.php?error=Invalid Login Details");
    }
}
else{
    header("Location:index.php?error=Please Enter Email and Password");
}
