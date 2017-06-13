<?php
require_once "../class/company-service.php";
$companyService = new CompanyService();
$update_company=$companyService->updateCompany($_POST,$_GET['companyId']);
header("location:../companydashboard.php");

?>
