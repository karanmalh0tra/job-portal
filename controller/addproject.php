<?php
require_once "../class/user-service.php";
$userService = new UserService();
$add_project=$userService->addProject($_POST,$_GET['userId']);
 ?>
