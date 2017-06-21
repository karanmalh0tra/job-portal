<?php

require_once '../class/admin-service.php';
$adminService = new AdminService();
$adminId=$_GET['adminId'];
$success = $adminService->deleteAdmin($adminId);

header("location:../manage-admin.php?delete=".$success);

?>