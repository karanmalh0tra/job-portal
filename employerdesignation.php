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
  $view_employerdesignation = $userService->viewEmployerDesignation($userId);
}

?>

<?php include "header.php";?>

<!--//TODO: Add multiple forms through scripts -->


<!-- =============== Start of Page Header 1 Section =============== -->
<section class="page-header">
  <div class="container">

    <!-- Start of Page Title -->
    <div class="row">
      <div class="col-md-12">
        <h2>EMPLOYER/DESIGNATION</h2>
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
        <form name="myemployerform" id="myemployerform" class="post-job-resume mt50" action="controller/employerdesignation.php?userId=<?php echo $userId; ?>" method="post" enctype="multipart/form-data">

          <!-- Start of Resume Details -->
          <div class="row">
            <div class="col-md-12">

              <!-- Form Group -->
              <div class="form-group">
                <label>Employer name</label>
                <input class="form-control" id="employer_name" type="text" name="employer_name" value="<?php echo $view_employerdesignation['employer_name']; ?>" required/>
              </div>

              <!-- Form Group -->
              <div class="form-group">
                <label>Duration</label>
                <h5>From</h5><input class="form-control" type="date" name="startdate" id="startdate" value="<?php echo $view_employerdesignation['start_date']; ?>">
                <h5>To</h5><input class="form-control" type="date" name="enddate" id="enddate" value="<?php echo $view_employerdesignation['end_date']; ?>">
              </div>

              <!-- Form Group -->
              <div class="form-group">
                <label>Designation</label>
                <input id="user_designation" class="form-control" type="text" name="user_designation" value="<?php echo $view_employerdesignation['user_designation']; ?>" required/>
              </div>

              <!-- Form Group -->
              <div class="form-group">
                <label>Job Profile</label>
                <textarea id="job_profile" class="form-control" name="job_profile" rows="2" cols="20"><?php echo $view_employerdesignation['job_profile']; ?></textarea>
              </div>

              <!-- Form Group -->
              <div class="form-group pt30 nomargin">
                <button type="submit" class="btn btn-blue btn-effect">submit</button>

              </div>

            </div>
          </div>
          <button class="btn btn-blue btn-effect add_field_button">Add Another</button>
          <!-- End of Resume Details -->

        </form>

      </div>
      <!-- End of Blog Posts -->

      <!-- Start of Blog Sidebar -->
      <div class="col-md-4 col-md-pull-8 col-xs-12 blog-sidebar">

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
            <li><a href="savedjobs.php">Saved Jobs</a></li>
            <li><a href="">Application History</a></li>
          </ul><br/><br/><br/>
          <h4 class="widget-title">Settings</h4>
          <ul class="sidebar-list">
            <li><a href="">Visibility Settings</a></li>
            <li><a href="changepassword.php">Change Password</a></li>
          </ul>
        </div>ul>
      </div>
      <!-- End of Categories -->

    </div>
    <!-- End of Blog Sidebar -->

  </div>
</div>
</section>
<!-- ===== End of Blog Listing Section ===== -->

<?php include "footer.php";?>
