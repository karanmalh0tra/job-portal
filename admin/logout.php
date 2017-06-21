<?php
@session_start();
unset($_SESSION['admin_email']);
echo "<script>window.open('login.php','_self')</script>";
session_destroy();
?>