<?php
require_once "../class/admin-service.php";

$adminService = new AdminService();
$getGallery = $adminService->addGallery($_POST);

//echo $getSubadmin;

if($getGallery != null && $getGallery != "")
{
	echo "<script>alert('Gallery Details Added Successfully..')</script>";
	echo "<script>window.open('../view-gallery.php','_self')</script>";
	//header("location:../addproduct.php");
}
else
{
	echo "<script>alert('Gallery Details is not Added..')</script>";
	echo "<script>window.open('../add-gallery.php','_self')</script>";
}

?>