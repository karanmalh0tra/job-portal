<?php

require_once '../class/admin-service.php';
$adminService = new AdminService();
$companyId=$_GET['companyId'];
$success = $adminService->deleteCompany($companyId);

header("location:../manage-company.php?delete=".$success);

?>
