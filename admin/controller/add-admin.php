<?php
require_once "../class/admin-service.php";

$adminService = new AdminService();
$success = $adminService->addAdmin($_POST);
echo $getSubadmin;

header("location:../add-admin.php?success=".$success);

?>