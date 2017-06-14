<?php
require_once "../class/company-service.php";
$companyService = new CompanyService();
$success=$companyService->searchEmployees($_POST);
header("location:../searchemployees.php");
 ?>
