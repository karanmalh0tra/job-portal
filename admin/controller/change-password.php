<?php
require_once '../class/admin-service.php';
$adminService = new AdminService();
$adminId=$_GET['adminId'];;


$password=$adminService->changePassword($adminId,$_POST);
header('location:../change-password.php?success='.$password);


?>