<?php
require_once "../class/user-service.php";
$userService = new UserService();
$success=$userService->changePassword($_POST,$_GET['userId']);
header("location:../changepassword.php?success=".$success);

?>
