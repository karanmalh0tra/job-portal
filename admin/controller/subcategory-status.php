<?php

require_once '../class/admin-service.php';
$adminService = new AdminService();
$success= $adminService->changeSubCategoryStatus($_REQUEST['subcategoryId']);
echo $success;

?>
