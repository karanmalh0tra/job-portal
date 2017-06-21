<?php
require_once "../class/admin-service.php";

$adminService = new AdminService();
$success = $adminService->addCategory($_POST);

header("location:../add-category.php?success=".$success);

?>