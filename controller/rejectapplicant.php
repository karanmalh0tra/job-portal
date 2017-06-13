<?php
require_once "../class/company-service.php";
$companyService = new CompanyService();
$reject_applicant=$companyService->applicantReject($_GET['userId'],$_GET['jobId']);
$jobId = $_GET['jobId'];
header("location:../viewappliedusers.php?jobId=$jobId");

?>
