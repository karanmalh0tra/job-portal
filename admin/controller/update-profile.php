<?php

require_once '../class/admin-service.php';
$adminService = new AdminService();
$adminId=$_GET['adminId'];
$success = $adminService->updateProfile($_POST,$adminId);

echo "<script>window.open('../profile.php?success=$success','_self')</script>"

?>