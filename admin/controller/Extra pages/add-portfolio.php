<?php
require_once "../class/admin-service.php";

$adminService = new AdminService();
$getPortfolio = $adminService->addPortfolio($_POST);

//echo $getSubadmin;

if($getPortfolio != null && $getPortfolio != "")
{
	echo "<script>alert('Portfolio Details Added Successfully..')</script>";
	echo "<script>window.open('../view-portfolio.php','_self')</script>";
	//header("location:../addproduct.php");
}
else
{
	echo "<script>alert('Portfolio Details is not Added..')</script>";
	echo "<script>window.open('../add-portfolio.php','_self')</script>";
}

?>