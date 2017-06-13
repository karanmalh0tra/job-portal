<?php
require_once "../class/company-service.php";
$companyService = new CompanyService();
$reject_applicant=$companyService->removeApplicantFromShortlist($_GET['userId'],$_GET['jobId']);
$jobId = $_GET['jobId'];
header("location:../shortlistedapplicants.php?jobId=$jobId");

?>
