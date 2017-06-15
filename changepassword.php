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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>

<script>
$(document).ready(function(){
  jQuery.noConflict()(function(){
    $("#changepasswordform").validate({
      rules: {
        oldPassword: {
          required: true,
          minlength: 6
        },
        newPassword: {
          required: true,
          minlength: 6

        },
        ConfirmNewPassword: {
          required: true,
          minlength: 6
        }
      },
      messages: {
        oldPassword: {
          required: "Please enter your password",
          minlength: "Enter a password of minimum length 6"
        },
        newPassword: {
          required: "Please enter your new password",
          minlength: "Enter a password of minimum length 6"
        },
        ConfirmNewPassword: {
          required: "Please enter your new password again",
          minlength: "Enter a password of minimum length 6"
        }
      }
    });
  });
});
</script>

<style>

#changepasswordform label.error, #changepasswordform input.submit {

  color:red;
}
</style>


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
                <form name="changepasswordform" id="changepasswordform" action="controller/changepassword.php?userId=<?php echo $userId; ?>" method="post">
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
