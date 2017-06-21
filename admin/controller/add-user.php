<?php
require_once "../class/user-service.php";

$userService = new UserService();
$success = $userService->newUser($_POST);
echo $getSubadmin;

header("location:../../user-register.php?success=".$success);

?>