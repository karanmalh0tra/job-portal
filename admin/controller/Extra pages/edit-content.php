<?php

require_once '../class/admin-service.php';
$adminService = new AdminService();
$contentId=$_GET['contentId'];
$editContent = $adminService->updateContent($_POST,$contentId);

//echo $editSubadminService;

if($editContent != null && $editContent != "")
{
	echo "<script>alert('Content Details Updated Successfully..')</script>";
	echo "<script>window.open('../view-content.php','_self')</script>";
	//header("location:../addproduct.php");
}
else
{
	echo "<script>alert('Content Details is not Updated..')</script>";
	echo "<script>window.open('../edit-content.php?edit'.$contentId,'_self')</script>";
}
?>