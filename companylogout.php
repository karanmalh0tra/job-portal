<?php

session_start();//session is a way to store information (in variables) to be used across multiple pages.
unset($_SESSION['company_id']);
unset($_SESSION['company_email']);
unset($_SESSION['company_name']);
session_destroy();
header("Location:index.php");//use for the redirection to some page
?>
