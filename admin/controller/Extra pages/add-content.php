<?php
require_once "../class/admin-service.php";

$adminService = new AdminService();
$getContent = $adminService->addContent($_POST);

//echo $getSubadmin;

if($getContent != null && $getContent != "")
{
	echo "<script>alert('Content Details Added Successfully..')</script>";
	echo "<script>window.open('../view-testimonial.php','_self')</script>";
	//header("location:../addproduct.php");
}
else
{
	echo "<script>alert('Content Details is not Added..')</script>";
	echo "<script>window.open('../add-testimonial.php','_self')</script>";
}

?>