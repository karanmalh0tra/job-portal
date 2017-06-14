<?php

$email = $_POST['email'];
$password = $_POST['pass'];

require_once "../class/user-service.php";
$userService = new UserService();
$success = $userService->authenticateUser($email,$password);
  if($success) {
    header("location:../dashboard.php");

  }
  else {
    echo "<script>alert('Invalid User Login..')</script>";
  	echo "<script>window.open('../index.php','_self')</script>";
  }


 ?>
