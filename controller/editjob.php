<?php
require_once "../class/company-service.php";
$companyService = new CompanyService();
$update_job=$companyService->updateJobDetails($_POST,$_GET['jobId']);
header("location:../modifyjob.php");

?>
