<?php

require_once '../class/admin-service.php';
$adminService = new AdminService();
$categoryId=$_GET['categoryId'];
$success = $adminService->deleteCategory($categoryId);

header("location:../manage-category.php?delete=".$success);

?>