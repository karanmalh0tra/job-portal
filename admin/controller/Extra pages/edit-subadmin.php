<?php

require_once '../class/admin-service.php';
$adminService = new AdminService();
$subadminid=$_GET['edit'];
$editSubadminService = $adminService->updateSubadmin($_POST,$subadminid);

//echo $editSubadminService;

if($editSubadminService != null && $editSubadminService != "")
{
	echo "<script>alert('Sub Admin Details Updated Successfully..')</script>";
	echo "<script>window.open('../view-subadmin.php','_self')</script>";
	//header("location:../addproduct.php");
}
else
{
	echo "<script>alert('Sub Admin Details is not Updated..')</script>";
	echo "<script>window.open('../editsubadmin.php?edit'.$subadminid,'_self')</script>";
}
?>