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
  $view_education = $userService->viewEducation($userId);
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
        <form name="myeducationform" id="myeducationform" class="post-job-resume mt50" action="controller/education.php?userId=<?php echo $userId; ?>" method="post">

          <!-- Start of Resume Details -->
          <div class="row">
            <div class="col-md-12">

              <!-- Form Group -->
              <div class="form-group">
                <label>Graduation</label>
                <select id="graduation" class="form-control" name="graduation">
                  <option value="">Select Graduation</option><?php
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
                  <label>Select Specialization</label>
                  <select class="form-control" name="specialization" id="specialization">
                    <option value="">Select Specialization</option><?php
                    foreach($view_role_by_fid as $rolefa)
                    {
                      ?>
                      <option <?php print($view_user['role_id']==$rolefa['role_id'] ?'selected="selected"': "") ?> value="<?php echo $rolefa['functionalarea_id']; ?>"><?php echo $rolefa['role_name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>University/Institute</label>
                    <input id="university" class="form-control" type="text" name="university" value="<?php echo $view_education['university_name']; ?>">
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Year of Graduation</label>
                    <!-- //TODO work on displaying selected year from table -->
                    <select name="graduationyear" id="selectElementId" class="form-control"></select>
                    <script>
                    var min = 1960,
                    max = new Date().getFullYear() + 4,
                    select = document.getElementById('selectElementId');
                    for (var i = max; i>=min; i--){
                      var opt = document.createElement('option');
                      opt.value = i;
                      opt.innerHTML = i;
                      select.appendChild(opt);
                    }
                    </script>
                  </div>

                  <div class="form-group">
                    <label>Grading System</label>
                    <!-- //TODO view year of graduation -->
                    <select id="gradingsystem" class="form-control" name="gradingsystem">
                      <option value="not specified">Select Grading System</option>
                      <option value="out of 10">Select 10 Grading System</option>
                      <option value="out of 4">Select 4 Grading System</option>
                      <option value="out of 100">% Marks of 100 Maximum</option>
                      <option value="requires pass">Course Requires a Pass</option>
                    </select>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>marks</label>
                    <input id="universitymarks" class="form-control" type="text" name="universitymarks" value="<?php echo $view_education['universty_marks']; ?>" required>
                  </div>

                  <br/><hr/><br/>

                  <div class="form-group">
                    <label>Class X Board</label>
                    <!--//TODO Make view Board function -->
                    <select id="xboard" class="form-control" name="xboard">
                      <option value="">Select Board</option>
                      <option value="CBSE">CBSE</option>
                      <option value="CISCE">CISCE(ICSE/ISC)</option>
                      <option value="DIPLOMA">DIPLOMA</option>
                      <option value="StateBoard">STATE BOARD</option>
                      <option value="NationalOpenSchool">National Open School</option>
                    </select>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Year of Passing</label>
                    <select id="xyear" name="xyear" class="form-control"></select>
                    <script>
                    var min = 1960,
                    max = new Date().getFullYear(),
                    select = document.getElementById('xyear');
                    for (var i = max; i>=min; i--){
                      var opt = document.createElement('option');
                      opt.value = i;
                      opt.innerHTML = i;
                      select.appendChild(opt);
                    }
                    </script>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>marks</label>
                    <input id="xmarks" class="form-control" type="text" name="xmarks" value="<?php echo $view_education['x_marks']; ?>" required>
                  </div>

                  <br/><hr/><br/>

                  <div class="form-group">
                    <label>Class XII Board</label>
                    <select id="xiiboard" class="form-control" name="xiiboard">
                      <option value="">Select Board</option>
                      <option value="CBSE">CBSE</option>
                      <option value="CISCE">CISCE(ICSE/ISC)</option>
                      <option value="DIPLOMA">DIPLOMA</option>
                      <option value="STATEBOARD">STATE BOARD</option>
                      <option value="NationalOpenSchool">National Open School</option>
                    </select>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Year of Passing</label>
                    <select id="xiiyear" name="xiiyear" class="form-control"></select>
                    <script>
                    var min = 1960,
                    max = new Date().getFullYear(),
                    select = document.getElementById('xiiyear');
                    for (var i = max; i>=min; i--){
                      var opt = document.createElement('option');
                      opt.value = i;
                      opt.innerHTML = i;
                      <?php if($opt.value==$view_education['xii_year']) echo 'selected="selected"'; ?>
                      select.appendChild(opt);
                    }
                    </script>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>marks</label>
                    <input id="xiimarks" class="form-control" type="text" name="xiimarks" value="<?php echo $view_education['xii_marks']; ?>">
                  </div>
                  <hr/>

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
