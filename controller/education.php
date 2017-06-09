<?php
require_once "../class/user-service.php";
$userService = new UserService();
$update_education=$userService->updateEducation($_POST,$_GET['userId']);
header("location:../dashboard.php");

?>
