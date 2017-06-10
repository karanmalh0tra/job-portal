<?php
session_start();

if(!$_SESSION['company_email'])
{
  header("Location: companylogin.php");
}
else {
  $companyId = $_SESSION['company_id'];
  require_once "class/company-service.php";
  $companyService = new CompanyService();
  $view_company = $companyService->viewCompany($companyId);
  $view_jobs_from_company = $companyService->viewJobFromCompany($companyId);
}

?>

<?php include "header.php";?>


<!-- =============== Start of Page Header 1 Section =============== -->
<section class="page-header">
  <div class="container">

    <!-- Start of Page Title -->
    <div class="row">
      <div class="col-md-12">
        <h2>COMPANY DASHBOARD</h2>
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


        <!-- ===== Start of Login - Register Section ===== -->





        <!-- Start of Login Box -->
        <div class="login-box">

          <div class="login-title">
            <h4>Change Password</h4><br/>
            <?php if(isset($_GET['success'])){
              if($_GET['success']==0){  ?>

                <?php	echo '<h4><b style="color:#b70000;"><span>Failed to change your password.</span></b></h4>'; ?>

                <?php } elseif($_GET['success']==1){ ?>

                  <?php	echo '<h4><center><b style="color:#f59422;background:#b70000;"><span>Your Password was succesfully changed.</span></b></center></h4>'; ?>

                  <?php }} ?>
                </div>

                <!-- Start of Login Form -->
                <form name="changecompanypasswordform" id="changecompanypasswordform" action="controller/changecompanypassword.php?companyId=<?php echo $companyId; ?>" method="post">
                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Enter Your Current Password</label>
                    <input type="password" class="form-control" placeholder="Current Password" name="oldPassword">
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Enter Your New Password</label>
                    <input type="password" class="form-control" placeholder="New Password" name="newPassword">
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Confirm your New Password</label>
                    <input type="password" class="form-control" placeholder="New Password" name="ConfirmNewPassword">
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <button class="btn btn-blue btn-effect">Change Password</button>
                  </div>

                </form>
                <!-- End of Login Form -->
              </div>
              <!-- End of Login Box -->




              <!-- ===== End of Login - Register Section ===== -->

            </div>
            <!-- End of Blog Posts -->


            <!-- Start of Blog Sidebar -->
            <div class="col-md-4 col-md-pull-8 col-xs-12 blog-sidebar">



              <!-- Start of Social Media -->



              <!-- Start of Categories -->
              <div class="col-md-12 mt40">
                <h4 class="widget-title">Company Profile</h4>
                <ul class="sidebar-list">
                  <li><a href="">Company Profile</a></li>
                </ul><br/><br/><br/>
                <h4 class="widget-title">Jobs</h4>
                <ul class="sidebar-list">
                  <li><a href="postedjobs.php">Posted Jobs</a></li>
                  <li><a href="">Package Details</a></li>
                  <li><a href="">Resume Search</a></li>
                </ul><br/><br/><br/>
                <h4 class="widget-title">Manage Jobs</h4>
                <ul class="sidebar-list">
                  <li><a href="postjob.php">Post a Job</a></li>
                  <li><a href="">Edit Jobs</a></li>
                  <li><a href="">Delete Jobs</a></li>
                  <li><a href="">Activate and Deactivate Jobs</a></li>
                </ul><br/><br/><br/>
                <h4 class="widget-title">Manage Applications</h4>
                <ul class="sidebar-list">
                  <li><a href="">View Applications</a></li>
                  <li><a href="">View Candidate Profile</a></li>
                  <li><a href="">Reply Candidate via Email</a></li>
                  <li><a href="">Save Profile</a></li>
                </ul><br/><br/><br/>
                <h4 class="widget-title">Saved Profiles</h4>
                <ul class="sidebar-list">
                  <li><a href="">View Candidate &amp; Profile</a></li>
                  <li><a href="">Reply Candidate via Email</a></li>
                  <li><a href="">Remove from Saved Listing</a></li>
                </ul><br/><br/><br/>
                <h4 class="widget-title">Account Settings</h4>
                <ul class="sidebar-list">
                  <li><a href="">Edit Profile</a></li>
                  <li><a href="changecompanypassword.php">Change Password</a></li>
                </ul>
              </ul><br/><br/><br/>
              <h4 class="widget-title">Buy Package</h4>
              <ul class="sidebar-list">
                <li><a href="">Free</a></li>
                <li><a href="">Starter</a></li>
                <li><a href="">Premium</a></li>
              </ul><br/><br/><br/>
            </div>
            <!-- End of Categories -->


          </div>
          <!-- End of Blog Sidebar -->

        </div>
      </div>
    </section>
    <!-- ===== End of Blog Listing Section ===== -->

    <?php include "footer.php";?>
