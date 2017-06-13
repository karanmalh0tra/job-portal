<?php
require_once "../class/company-service.php";
$companyService = new CompanyService();
$accept_applicant=$companyService->applicantAccept($_GET['userId'],$_GET['jobId']);
$jobId = $_GET['jobId'];
header("location:../viewappliedusers.php?jobId=$jobId");

?>
