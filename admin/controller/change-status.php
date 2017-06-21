<?php
//$propertyId=$_GET['propertyId'];
$status=$_GET['status'];
$adminId=$_GET['adminId'];
require_once '../class/admin-service.php';
$adminService = new AdminService();
$action=$adminService->changeStatus($status, $adminId);



header("location:../view-subadmin.php");



?>