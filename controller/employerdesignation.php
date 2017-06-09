<?php
require_once "../class/user-service.php";
$userService = new UserService();
$update_employerdesignation=$userService->updateEmployerDesignation($_POST,$_GET['userId']);
header("location:../dashboard.php");

?>
