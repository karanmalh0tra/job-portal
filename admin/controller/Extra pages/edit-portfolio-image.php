<?php

require_once '../class/admin-service.php';
$adminService = new AdminService();
$imageId=$_GET['imageId'];
$porfolioId=$_GET['porfolioId'];
$edit = $adminService->updatePortfolioImage($_POST,$imageId);

//echo $editSubadminService;

if($edit != null && $edit != "")
{
	echo "<script>alert('Image Details Updated Successfully..')</script>";
//	echo "<script>window.open('../view-portfolio-images.php?portfolioId='.$porfolioId,'_self')</script>";
	header("location:../view-portfolio-images.php?portfolioId=".$porfolioId."&edit=".$edit);  
}
else
{
	echo "<script>alert('Image Details is not Updated..')</script>";
	header("location:../edit-portfolio-image.php?imageId=".$porfolioId."&porfolioId=".$porfolioId."&edit=".$edit); 
//	echo "<script>window.open('../edit-portfolio-image.php?imageId='.$imageId.'&porfolioId='.$porfolioId,'_self')</script>";
}
?>