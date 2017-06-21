<?php

require_once "../class/admin-service.php";

$adminService = new AdminService();
$subcategoryId=$_GET['subcategoryId'];

$success = $adminService->updateSubCategory($_POST,$subcategoryId);

	echo "<script>window.open('../manage-sub-category.php?success=$success','_self')</script>";

?>