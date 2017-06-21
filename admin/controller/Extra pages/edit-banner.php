<?php
require_once '../class/admin-service.php';
$adminService = new AdminService();
//$adminId;

$bannerId=$_GET['bannerId'];

$editBanner=$adminService->editBanner($_POST, $bannerId);

//header('location:../admin/view-banner.php?edit='.$edit);
//echo $editSubadminService;

if($editBanner != null && $editBanner != "")
{
	echo "<script>alert('Banner Details Updated Successfully..')</script>";
	echo "<script>window.open('../view-banner.php','_self')</script>";
	//header("location:../addproduct.php");
}
else
{
	echo "<script>alert('Banner Details is not Updated..')</script>";
	echo "<script>window.open('../edit-banner.php?bannerId='.$bannerId,'_self')</script>";
}
?>