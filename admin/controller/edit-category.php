<?php

require_once '../class/admin-service.php';
$adminService = new AdminService();
$categoryId=$_GET['categoryId'];
$success = $adminService->updateCategory($_POST,$categoryId);

echo "<script>window.open('../manage-category.php?success=$success','_self')</script>";

?>