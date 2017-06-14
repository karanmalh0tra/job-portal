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
<!-- // TODO: Jquery validation conflict -->
<script>
jQuery.noConflict();
jQuery(document).ready(function(){
  jQuery("div").hide();
  jQuery("#myform").validate({
    rules: {
      name: "required",
      location: "required",
      industry: "required",
      functionalarea: "required",
      role: "required",
      gender: "required",
      maritalStatus: "required",
      email: {
        required: true,
        email: true
      },
      mobile: {
        required: true,
        minlength: 10,
        maxlength: 10,
        digits: true
      }
    },
    messages: {
      name: "Enter your name",
      location: "Please select a location",
      industry: "Please select an industry",
      functionalarea: "Please select a functional area",
      role: "Please select a role",
      gender: "Please select a gender",
      maritalStatus: "Please select your Marital Status",
        email: {
          required: "Please enter your email ID",
          email: "Please enter a valid email address"
        },
        mobile: {
          required: "Please enter your mobile number",
          minlength: "Please Enter a 10 digit mobile number",
          maxlength: "Please Enter a 10 digit mobile number",
          digits: "Please only enter numbers"
        }
    }
  });
});
});
</script>

    <style>

  #myform label.error, #myform input.submit {

    color:red;
  }
  </style>


    <!-- =============== Start of Page Header 1 Section =============== -->
    <section class="page-header">
        <div class="container">

            <!-- Start of Page Title -->
            <div class="row">
                <div class="col-md-12">
                    <h2>Profile Summary</h2>
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
                  Your Profile Summary should mention the highlights of your career and education, what your professional interests are, and what kind of a career you are looking for.


                    <!-- Start of Blog Post Article 1 -->
                    <form name="myform" id="myform" class="post-job-resume mt50" action="controller/profilesummary.php?userId=<?php echo $userId; ?>" method="post" enctype="multipart/form-data">

                      <!-- Start of Resume Details -->
                        <div class="row">
                          <div class="col-md-12">

                              <!-- Form Group -->
                              <div class="form-group">
                                  <label>Profile Summary</label>
                                  <textarea id="profile_summary" class="form-control" name="profile_summary" rows="11" cols="40"><?php echo $view_user['profile_summary']; ?></textarea>
                              </div>



                              <!-- Form Group -->
                              <div class="form-group pt30 nomargin">
                                  <button type="submit" class="btn btn-blue btn-effect">submit</button>
                              </div>

                          </div>
                      </div>
                      <!-- End of Resume Details -->

                    </form>

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
                            <li><a href="savedjobs.php">Saved Jobs</a></li>
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
