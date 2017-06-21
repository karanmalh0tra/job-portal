<?php

require_once '../class/admin-service.php';
$adminService = new AdminService();
$success= $adminService->changeStatus($_REQUEST['adminId']);
echo $success;

?>
