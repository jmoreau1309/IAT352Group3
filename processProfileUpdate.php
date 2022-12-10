<?php
 
 include('header.php');
 include('./assets/functions.php');
 require('./data/db.php');
 if(isset($_POST['edit']))
 {
    $user_id=$_SESSION['user_id'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $select= "select * from users where user_id='$user_id'";
    $sql = mysqli_query($conn,$select);
    $row = mysqli_fetch_assoc($sql);
    $res= $row['user_id'];
    if($res === $user_id)
    {
   
       $update = "update users set username='$username',password='$password',email='$email' where user_id='$user_id'";
       $sql2=mysqli_query($conn,$update);
if($sql2)
       { 
           /*Successful*/
           header('location:profile.php');
       }
       else
       {
           /*sorry your profile is not update*/
           header('location:editProfile.php');
       }
    }
    else
    {
        /*sorry your id is not match*/
        header('location:editProfile.php');
    }
 }
?>
