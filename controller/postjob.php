<?php
require_once "../class/company-service.php";
$companyService = new CompanyService();
$success=$companyService->addJob($_POST,$_GET['companyId']);
header("location:../companydashboard.php");
 ?>
