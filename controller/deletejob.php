<?php
require_once "../class/company-service.php";
$companyService = new CompanyService();
$delete_job=$companyService->deleteJob($_GET['jobId']);
header("location:../modifyjob.php");

?>
