<?php
require_once "../class/admin-service.php";

$adminService = new AdminService();
$success = $adminService->addSubCategory($_POST);

	echo "<script>window.open('../add-sub-category.php?success=$success','_self')</script>";

?>