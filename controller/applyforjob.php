<?php
session_start();

if(empty($_SESSION["user_id"])){
echo -1;
}else{
  require_once "../class/company-service.php";
  $companyService = new CompanyService();

  $success=$companyService->applyForJob($_SESSION["user_id"],$_GET['jobId']);
  echo $success;
}



?>
