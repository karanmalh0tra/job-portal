<?php
require_once "../class/company-service.php";
$companyService = new CompanyService();
$success=$companyService->changePassword($_POST,$_GET['companyId']);
header("location:../changecompanypassword.php?success=".$success);

?>
