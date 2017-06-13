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
  $view_industry=$userService->viewIndustry();
  $view_functionalarea=$userService->viewFunctionalArea();
}

?>

<?php include "header.php";?>


<!-- =============== Start of Page Header 1 Section =============== -->
<section class="page-header">
  <div class="container">

    <!-- Start of Page Title -->
    <div class="row">
      <div class="col-md-12">
        <h2>USER DASHBOARD</h2>
      </div>
    </div>
    <!-- End of Page Title -->

    <!-- Start of Breadcrumb -->
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="#">home</a></li>
        </ul>
      </div>
    </div>
    <!-- End of Breadcrumb -->

  </div>
</section>
<!-- =============== End of Page Header 1 Section =============== -->





<!-- ===== Start of Blog Listing Section ===== -->
<section class="blog-listing ptb80" id="version1">
  <div class="container">
    <div class="row">

      <!-- Start of Blog Posts -->
      <div class="col-md-8 col-md-push-4 col-xs-12 blog-posts-wrapper">

        <!-- Start of Blog Post Article 1 -->
        <article class="col-md-12 blog-post">

          <!-- Blog Post Thumbnail -->
          <div class="col-md-4 blog-thumbnail">
            <a href="blog-post-right-sidebar.html" class="hover-link"><img src="images/blog/blog1.jpg" class="img-responsive" alt=""></a>
            <div class="date">
              <span class="day">15</span>
              <span class="publish-month">Mar</span>
            </div>
          </div>

          <!-- Blog Post Description -->
          <div class="col-md-8 blog-desc">
            <h5><a href="blog-post-right-sidebar.html">top 10 tips for web developers</a></h5>
            <div class="post-detail pt10 pb20">
              <span><i class="fa fa-user"></i>Author</span>
              <span><i class="fa fa-clock-o"></i>4:30</span>
              <span><i class="fa fa-comments-o"></i>12 Comments</span>
            </div>

            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book....</p>
            <a href="blog-post-right-sidebar.html" class="btn btn-blue btn-effect mt10">read more</a>
          </div>
        </article>
        <!-- End of Blog Post Article 1 -->

      </div>
      <!-- End of Blog Posts -->


      <!-- Start of Blog Sidebar -->
      <div class="col-md-4 col-md-pull-8 col-xs-12 blog-sidebar">



        <!-- Start of Social Media -->



        <!-- Start of Categories -->
        <div class="col-md-12 mt40">
          <h4 class="widget-title">My Profile</h4>
          <ul class="sidebar-list">
            <li><a href="userprofile.php">My Profile</a></li>
          </ul><br/><br/><br/>
          <h4 class="widget-title">Update Profile</h4>
          <ul class="sidebar-list">
            <li><a href="profilesnapshot1.php">Snapshot</a></li>
            <li><a href="profilesummary.php">Profile Summary</a></li>
            <li><a href="employerdesignation.php">Employer/Designation</a></li>
            <li><a href="education.php">Education</a></li>
          </ul><br/><br/><br/>
          <h4 class="widget-title">Jobs and Applications</h4>
          <ul class="sidebar-list">
            <li><a href="">Saved Jobs</a></li>
            <li><a href="">Application History</a></li>
          </ul><br/><br/><br/>
          <h4 class="widget-title">Settings</h4>
          <ul class="sidebar-list">
            <li><a href="">Visibility Settings</a></li>
            <li><a href="changepassword.php">Change Password</a></li>
          </ul>
        </div>
        <!-- End of Categories -->


      </div>
      <!-- End of Blog Sidebar -->

    </div>
  </div>
</section>
<!-- ===== End of Blog Listing Section ===== -->

<?php include "footer.php";?>
