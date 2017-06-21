<?php
require_once "../class/admin-service.php";

$adminService = new AdminService();
$getBanner = $adminService->addBanner($_POST);

//echo $getSubadmin;

if($getBanner != null && $getBanner != "")
{
	echo "<script>alert('Banner Details Added Successfully..')</script>";
	echo "<script>window.open('../view-banner.php','_self')</script>";
	//header("location:../addproduct.php");
}
else
{
	echo "<script>alert('Banner Details is not Added..')</script>";
	echo "<script>window.open('../add-banner.php','_self')</script>";
}

?>