<?php

$email = $_POST['companyemail'];
$password = $_POST['companypass'];

require_once "../class/company-service.php";
$companyService = new CompanyService();
$success = $companyService->authenticateCompany($email,$password);
  if($success) {
    header("location:../company-detail.php");

  }
  else {
    echo "<script>alert('Invalid Company Login..')</script>";
  	echo "<script>window.open('../index.php','_self')</script>";
  }


 ?>
