<?php

$email = $_POST['email'];
$password = $_POST['password'];


require_once '../class/admin-service.php';
$adminService = new AdminService();
$success = $adminService->authenticateAdmin($email, $password);
if($success)
{ 
	if($_SESSION['role'] == "Admin"){
		header("location:../dashboard.php");
	}
	else if($_SESSION['role'] == "SubAdmin"){
		header("location:../dashboard-subadmin.php");
	}
}
else
{
	echo "<script>alert('Invalid User Login..')</script>";
	echo "<script>window.open('../login.php','_self')</script>";
	
}

?>
