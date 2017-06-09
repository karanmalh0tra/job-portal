<?php
require_once "../class/user-service.php";
$userService = new UserService();
$profile_summary=$userService->updateSummary($_POST,$_GET['userId']);
header("location:../dashboard.php");

?>
