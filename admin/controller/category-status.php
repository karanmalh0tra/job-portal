<?php

require_once '../class/admin-service.php';
$adminService = new AdminService();
$success= $adminService->changeCategoryStatus($_REQUEST['categoryId']);
echo $success;

?>
