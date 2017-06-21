<?php
require_once "../class/admin-service.php";
$adminId = $_GET['adminId'];
$adminService = new AdminService();
$success = $adminService->updateAdmin($_POST,$adminId);

header("location:../manage-admin.php?success=".$success);

?>