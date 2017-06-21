<?php

require_once '../class/admin-service.php';
$adminService = new AdminService();
$userId=$_GET['userId'];
$success = $adminService->deleteUser($userId);

header("location:../manage-user.php?delete=".$success);

?>
