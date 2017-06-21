<?php

require_once '../class/admin-service.php';
$adminService = new AdminService();
$testimonialId=$_GET['testimonialId'];
$editTesimonial = $adminService->updateTesimonial($_POST,$testimonialId);

//echo $editSubadminService;

if($editTesimonial != null && $editTesimonial != "")
{
	echo "<script>alert('Tesimonial Details Updated Successfully..')</script>";
	echo "<script>window.open('../view-testimonial.php','_self')</script>";
	//header("location:../addproduct.php");
}
else
{
	echo "<script>alert('Tesimonial Details is not Updated..')</script>";
	echo "<script>window.open('../edit-testimonial.php?edit'.$tesimonialId,'_self')</script>";
}
?>