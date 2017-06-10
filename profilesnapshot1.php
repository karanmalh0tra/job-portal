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
        <h2>UPDATE PROFILE SNAPSHOT</h2>
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
        <form name="myform" id="myform" class="post-job-resume mt50" action="controller/profilesnapshot.php?userId=<?php echo $userId; ?>" method="post" enctype="multipart/form-data">

          <!-- Start of Resume Details -->
          <div class="row">
            <div class="col-md-12">

              <!-- Form Group -->
              <div class="form-group">
                <label>your name</label>
                <input class="form-control" id="name" type="text" name="name" value="<?php echo $view_user['user_name']; ?>" required/>
              </div>

              <!-- Form Group -->
              <!--TODO: View the date of birth from the database -->
              <div class="form-group">
                <label>date of birth</label>
                <input class="form-control" type="date" name="date_of_birth" id="date_of_birth" value="<?php echo $view_user['date_of_birth']; ?>">
              </div>

              <!-- Form Group -->
              <div class="form-group">
                <label>resume headline</label>
                <textarea id="resume_headline" class="form-control" name="resume_headline" rows="4" cols="50"><?php echo $view_user['resume_headline']; ?></textarea>
              </div>

              <!-- Form Group -->
              <div class="form-group">
                <label>total experience</label>
                <select name="experience" id="experience" onchange="" class="form-control" size="1">
                  <option value="--" selected>Experience</option>
                  <option value="00" <?php print($view_user['user_experience']=="0" ?'selected="selected"': "") ?>>Fresher</option>
                  <option value="01" <?php print($view_user['user_experience']=="01" ?'selected="selected"': "") ?>>01</option>
                  <option value="02" <?php print($view_user['user_experience']=="02" ?'selected="selected"': "") ?>>02</option>
                  <option value="03" <?php print($view_user['user_experience']=="03" ?'selected="selected"': "") ?>>03</option>
                  <option value="04" <?php print($view_user['user_experience']=="04" ?'selected="selected"': "") ?>>04</option>
                  <option value="05" <?php print($view_user['user_experience']=="05" ?'selected="selected"': "") ?>>05</option>
                  <option value="06" <?php print($view_user['user_experience']=="06" ?'selected="selected"': "") ?>>06</option>
                  <option value="07" <?php print($view_user['user_experience']=="07" ?'selected="selected"': "") ?>>07</option>
                  <option value="08" <?php print($view_user['user_experience']=="08" ?'selected="selected"': "") ?>>08</option>
                  <option value="09" <?php print($view_user['user_experience']=="09" ?'selected="selected"': "") ?>>09</option>
                  <option value="10" <?php print($view_user['user_experience']=="10" ?'selected="selected"': "") ?>>10</option>
                  <option value="11" <?php print($view_user['user_experience']=="11" ?'selected="selected"': "") ?>>11</option>
                  <option value="12" <?php print($view_user['user_experience']=="12" ?'selected="selected"': "") ?>>12</option>
                  <option value="13" <?php print($view_user['user_experience']=="13" ?'selected="selected"': "") ?>>13</option>
                  <option value="14" <?php print($view_user['user_experience']=="14" ?'selected="selected"': "") ?>>14</option>
                  <option value="15" <?php print($view_user['user_experience']=="15" ?'selected="selected"': "") ?>>15</option>
                  <option value="16" <?php print($view_user['user_experience']=="16" ?'selected="selected"': "") ?>>16</option>
                  <option value="17" <?php print($view_user['user_experience']=="17" ?'selected="selected"': "") ?>>17</option>
                  <option value="18" <?php print($view_user['user_experience']=="18" ?'selected="selected"': "") ?>>18</option>
                  <option value="19" <?php print($view_user['user_experience']=="19" ?'selected="selected"': "") ?>>19</option>
                  <option value="20" <?php print($view_user['user_experience']=="20" ?'selected="selected"': "") ?>>20</option>
                  <option value="21" <?php print($view_user['user_experience']=="21" ?'selected="selected"': "") ?>>21</option>
                  <option value="22" <?php print($view_user['user_experience']=="22" ?'selected="selected"': "") ?>>22</option>
                  <option value="23" <?php print($view_user['user_experience']=="23" ?'selected="selected"': "") ?>>23</option>
                  <option value="24" <?php print($view_user['user_experience']=="24" ?'selected="selected"': "") ?>>24</option>
                  <option value="25" <?php print($view_user['user_experience']=="25" ?'selected="selected"': "") ?>>25</option>
                  <option value="26" <?php print($view_user['user_experience']=="26" ?'selected="selected"': "") ?>>26</option>
                  <option value="27" <?php print($view_user['user_experience']=="27" ?'selected="selected"': "") ?>>27</option>
                  <option value="28" <?php print($view_user['user_experience']=="28" ?'selected="selected"': "") ?>>28</option>
                  <option value="29" <?php print($view_user['user_experience']=="29" ?'selected="selected"': "") ?>>29</option>
                  <option value="30" <?php print($view_user['user_experience']=="30" ?'selected="selected"': "") ?>>30+</option>
                </select>
              </div>

              <!-- Form Group -->
              <div class="form-group">
                <label>location</label>
                <input id="location" class="form-control" type="text" name="location" value="<?php echo $view_user['user_location']; ?>" required/>
              </div>

              <!-- Form Group -->
              <div class="form-group">
                <label>industry</label>
                <select id="industry" class="form-control" name="industry">
                  <option value="">Select Industry</option><?php
                  foreach($view_industry as $industry)
                  {
                    ?>
                    <option <?php print($view_user['industry_id']==$industry['industry_id'] ?'selected="selected"': "") ?> value="<?php echo $industry['industry_id']; ?>">
                      <?php echo $industry['industry_name']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>

                <!-- Form Group -->
                <div class="form-group">
                  <label>mobile</label>
                  <input id="mobile" class="form-control" type="text" name="mobile" value="<?php echo $view_user['user_mobile']; ?>" required>
                </div>

                <!-- Form Group -->
                <div class="form-group">
                  <label>email</label>
                  <input id="email" class="form-control" type="email" name="email" value="<?php echo $view_user['user_email']; ?>" required>
                </div>

                <!-- Form Group -->
                <div class="form-group">
                  <label>functional area</label>
                  <select class="form-control" name="functionalarea" id="functionalarea">
                    <option value="">Select Functional Area</option><?php
                    foreach($view_functionalarea as $functionalarea)
                    {
                      ?>
                      <option <?php print($view_user['functionalarea_id']==$functionalarea['functionalarea_id'] ?'selected="selected"': "") ?>value="<?php echo $functionalarea['functionalarea_id']; ?>"><?php echo $functionalarea['functionalarea_name']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>

                <!-- Form Group -->
                <div class="form-group">
                  <label>role</label>
                  <select class="form-control" name="role" id="role">
                    <option value="">Select Role</option><?php
                    foreach($view_role_by_fid as $rolefa)
                    {
                      ?>
                      <option <?php print($view_user['role_id']==$rolefa['role_id'] ?'selected="selected"': "") ?> value="<?php echo $rolefa['functionalarea_id']; ?>"><?php echo $rolefa['role_name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>key skills</label>
                    <textarea id="user_key_skills" class="form-control" name="user_key_skills" rows="1" cols="50" placeholder="none"><?php echo $view_user['user_key_skills']; ?></textarea>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>permanent address</label>
                    <textarea id="address" class="form-control" name="address" rows="3" cols="50" placeholder="none"><?php echo $view_user['address']; ?></textarea>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>home town/city</label>
                    <textarea id="hometown" class="form-control" name="hometown" rows="1" cols="20" placeholder="none"><?php echo $view_user['hometown']; ?></textarea>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>pincode</label>
                    <textarea id="pincode" class="form-control" name="pincode" rows="1" cols="20" placeholder="none"><?php echo $view_user['pincode']; ?></textarea>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>gender</label>
                    <select id="gender" class="form-control" name="gender" required/>
                    <option value="-1">Select Gender</option> <option value="M" <?php print($view_user['user_gender']=="M" ?'selected="selected"': "") ?>>Male</option>
                    <option value="F" <?php print($view_user['user_gender']=="F" ?'selected="selected"': "") ?>>Female</option>
                  </select>
                </div>

                <!-- Form Group -->
                <div class="form-group">
                  <label>marital status</label>
                  <select id="maritalStatus" class="form-control" name="maritalStatus">
                    <option value="-1">Select</option> <option value="N"  <?php print($view_user['marital_status']=="N" ?'selected="selected"': "") ?>>Single/unmarried</option>
                    <option value="M" <?php print($view_user['marital_status']=="M" ?'selected="selected"': "") ?>>Married</option>
                    <option value="W" <?php print($view_user['marital_status']=="W" ?'selected="selected"': "") ?>>Widowed</option>
                    <option value="D" <?php print($view_user['marital_status']=="D" ?'selected="selected"': "") ?>>Divorced</option>
                    <option value="S" <?php print($view_user['marital_status']=="S" ?'selected="selected"': "") ?>>Separated</option>
                    <option value="O" <?php print($view_user['marital_status']=="O" ?'selected="selected"': "") ?>>Other</option>
                  </select>
                </div>

                <!-- Form Group -->
                <div class="form-group">
                  <label>your photo <span>(optional)</span></label>

                  <!-- Upload Button -->
                  <div class="upload-file-btn">
                    <span><i class="fa fa-upload"></i> Upload</span>
                    <input type="file" name="newimage" accept=".jpg,.png,.gif">
                    <input type="hidden" name="oldimage" value="<?php echo $view_user['imagepath']; ?>">
                  </div>
                  <img class="form-control" src="<?php echo $view_user['imagepath']; ?>">
                </div>

                <!-- Form Group -->
                <div class="form-group">
                  <label>resume <span>(optional)</span></label>
                  <input class="form-control" type="file" name="newresumefile" placeholder='upload a copy of your resume'>
                  <input type="hidden" name="oldresumefile" value="<?php echo $view_user['resumepath']; ?>">
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
