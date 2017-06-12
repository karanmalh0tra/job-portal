<?php
require_once "../class/company-service.php";
$companyService = new CompanyService();
$success=$companyService->updateJobStatus($_GET['jobId']);
echo $success;

?>
