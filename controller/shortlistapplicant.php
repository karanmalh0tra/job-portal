<?php
require_once "../class/company-service.php";
$companyService = new CompanyService();
$shortlist_applicant=$companyService->applicantShortlist($_GET['userId'],$_GET['jobId']);
$jobId = $_GET['jobId'];
header("location:../viewappliedusers.php?jobId=$jobId");

?>
