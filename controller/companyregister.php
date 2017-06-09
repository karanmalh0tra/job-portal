<?php
require_once "../class/company-service.php";

$companyService = new CompanyService();
$success = $companyService->newCompany($_POST);
//echo $getSubadmin;

header("location:../companylogin.php?success=".$success);

?>
