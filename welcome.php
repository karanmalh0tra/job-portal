<?php
session_start();

if(!$_SESSION['user_email'])
{
  header("Location: login.php");
}
else {
  $userId = $_SESSION['user_id'];
  require_once "class/user-service.php";
  $userService = new UserService();
  $view_user = $userService->viewUser($userId);
}

 ?>

 <?php include "header.php";?>

 <section class="page-header">
     <div class="container">

         <!-- Start of Page Title -->
         <div class="row">
             <div class="col-md-12">
                 <h2>welcome</h2>
             </div>
         </div>
         <!-- End of Page Title -->

         <!-- Start of Breadcrumb --> <!--
         <div class="row">
             <div class="col-md-12">
                 <ul class="breadcrumb">
                     <li><a href="#">home</a></li>
                     <li class="active">pages</li>
                 </ul>
             </div>
         </div> -->
         <!-- End of Breadcrumb -->

     </div>
 </section>


 <?php include "footer.php";?>
