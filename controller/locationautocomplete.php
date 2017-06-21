<?php
require_once "../class/company-service.php";
$companyService = new CompanyService();
$locationsearch=$companyService->getCity($_GET['locationName']);

$json = array();
foreach($locationsearch as $loc){
   $json[]=array(
  'value'=> $loc["job_location"],
  'label'=> $loc["job_location"]." - ".$loc["job_id"]
);

}
echo json_encode($json);

?>
