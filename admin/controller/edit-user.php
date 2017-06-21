<?php
require_once "../class/admin-service.php";
$userId = $_GET['userId'];
$adminService = new AdminService();
$success = $adminService->updateUser($_POST,$userId);

header("location:../manage-user.php?success=".$success);

?>
