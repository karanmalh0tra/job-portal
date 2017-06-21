<?php

require_once '../class/admin-service.php';
$adminService = new AdminService();
$subcategoryId=$_GET['subcategoryId'];
$success = $adminService->deleteSubCategory($subcategoryId);

header("location:../manage-sub-category.php?delete=".$success);

?>