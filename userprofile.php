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
        <h2>USER PROFILE</h2>
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



          <!-- Blog Post Description -->
          <div class="blog-desc">
            <h5><a href="blog-post-right-sidebar.html">User Profile</a></h5>
            <br/>
            <h6><?php echo $view_user['user_name']; ?></h6>
            <br/>
            <p><h6>Resume Headline:</h6> <?php echo $view_user['resume_headline']; ?></p>
            <ul style="padding-left:0;">
              <li><h6>Profile Image</h6><span><img class="form-control" src="<?php echo $view_user['imagepath']; ?>"></span></li>
              <li><h6>Current Location:</h6><span><?php echo $view_user['user_location']; ?></span></li>
              <li><h6>Functional Area:</h6><span><?php //echo $view_user['resume_headline']; ?></span></li>
              <li><h6>Role:</h6><span><?php //echo $view_user['resume_headline']; ?></span></li>
              <li><h6>Industry:</h6><span><?php //echo $view_user['resume_headline']; ?></span></li>
              <li><h6>Date of Birth:</h6><span><?php echo $view_user['date_of_birth']; ?></span></li>
              <li><h6>Gender:</h6><span></span><?php echo $view_user['user_gender']; ?></li>
              <li><h6>Key Skills:</h6><span><?php echo $view_user['user_key_skills']; ?></span></li>
            </ul>
              <ul style="padding-left:0;">
                <li><h6>Total Experience:</h6><span><?php echo $view_user['user_experience']; ?></span>&emsp;<i>Years</i></li>
                <li><h6>Phone:</h6><span><?php echo $view_user['user_mobile']; ?></span></li>
                <li><h6>Email:</h6><span><?php echo $view_user['user_email']; ?></span></li>
                <li><h6>Permanent Addres:</h6><span><?php echo $view_user['address']; ?></span></li>
                <li><h6>Hometown/City:</h6><span><?php echo $view_user['hometown']; ?></span></li>
                <li><h6>Pin Code:</h6><span><?php echo $view_user['pincode']; ?></span></li>
                <li><h6>Marital Status:</h6><span><?php echo $view_user['marital_status']; ?></span></li>
              </ul>
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
