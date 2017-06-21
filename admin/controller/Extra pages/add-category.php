<?php
require_once "../class/admin-service.php";

$adminService = new AdminService();
$getCategory = $adminService->addCategory($_POST);

//echo $getSubadmin;

if($getCategory != null && $getCategory != "")
{
	echo "<script>alert('Category Details Added Successfully..')</script>";
	echo "<script>window.open('../add-category.php','_self')</script>";
	//header("location:../addproduct.php");
}
else
{
	echo "<script>alert('Category Details is not Added..')</script>";
	echo "<script>window.open('../add-category.php','_self')</script>";
}

?>