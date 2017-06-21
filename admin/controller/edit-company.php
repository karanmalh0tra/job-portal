<?php
require_once "../class/admin-service.php";
$companyId = $_GET['companyId'];
$adminService = new AdminService();
$success = $adminService->updateCompany($_POST,$companyId);

header("location:../manage-company.php?success=".$success);

?>
