<?php

include '../includes/database.php';

extract($_POST);

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['department']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $department=$_POST['department'];
    
    $query = "INSERT INTO `department_admin`(`username`, `password`, `department`) VALUES ('$username','$password','$department')";
    mysqli_query($connect,$query);
   
}

?>