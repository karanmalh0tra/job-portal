<?php
require_once '../class/admin-service.php';
$adminService = new AdminService();
//$adminId;

$galleryId=$_GET['galleryId'];

$editGallery=$adminService->editGallery($_POST, $galleryId);

//header('location:../admin/view-banner.php?edit='.$edit);
//echo $editSubadminService;

if($editGallery != null && $editGallery != "")
{
	echo "<script>alert('Gallery Details Updated Successfully..')</script>";
	echo "<script>window.open('../view-gallery.php','_self')</script>";
	//header("location:../addproduct.php");
}
else
{
	echo "<script>alert('Gallery Details is not Updated..')</script>";
	echo "<script>window.open('../edit-gallery.php?galleryId='.$galleryId,'_self')</script>";
}
?>