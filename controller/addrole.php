<?php
require_once "../class/user-service.php";
$userService = new UserService();
$add_role=$userService->addRole($_POST);
header("location:../addrole.php");

?>
