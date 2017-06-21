<?php

require_once '../class/admin-service.php';
$adminService = new AdminService();
$portfolioId=$_GET['portfolioId'];
$editPortfolio = $adminService->editPortfolio($_POST,$portfolioId);

//echo $editSubadminService;

if($editPortfolio != null && $editPortfolio != "")
{
	echo "<script>alert('Portfolio Details Updated Successfully..')</script>";
	echo "<script>window.open('../view-portfolio.php','_self')</script>";
	//header("location:../addproduct.php");
}
else
{
	echo "<script>alert('Portfolio Details is not Updated..')</script>";
	echo "<script>window.open('../edit-portfolio.php?edit'.$portfolioId,'_self')</script>";
}
?>