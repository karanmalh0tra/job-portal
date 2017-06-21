<?php
require_once "../class/admin-service.php";

$adminService = new AdminService();
$getTestimonial = $adminService->addTestimonial($_POST);

//echo $getSubadmin;

if($getTestimonial != null && $getTestimonial != "")
{
	echo "<script>alert('Testimonial Details Added Successfully..')</script>";
	echo "<script>window.open('../view-testimonial.php','_self')</script>";
	//header("location:../addproduct.php");
}
else
{
	echo "<script>alert('Testimonial Details is not Added..')</script>";
	echo "<script>window.open('../add-testimonial.php','_self')</script>";
}

?>