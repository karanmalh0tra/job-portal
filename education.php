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
  $view_education = $userService->viewEducation($userId);
  $view_graduation=$userService->viewGraduation();
  $view_specialization=$userService->viewSpecialization($view_education['graduation_id']);
}

?>

<?php include "header.php";?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>

<script>
$(document).ready(function(){
  jQuery.noConflict()(function(){
    $("#myeducationform").validate({
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

#myeducationform label.error, #myeducationform input.submit {

  color:red;
}
</style>

<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("#graduation").change(function() {
  //  alert( $(this).val());
		$(this).after('<div id="loader"><img src="img/loading.gif" alt="loading subcategory" /></div>');
		$.get('controller/loadspecialization.php?graduation=' + $(this).val(), function(data) {
			$("#specialization").html(data);
			$('#loader').slideUp(200, function() {
				$(this).remove();
			});
		});
    });

});
</script>


<!-- =============== Start of Page Header 1 Section =============== -->
<section class="page-header">
  <div class="container">

    <!-- Start of Page Title -->
    <div class="row">
      <div class="col-md-12">
        <h2>UPDATE Education</h2>
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
                  foreach($view_graduation as $graduation)
                  {
                    ?>
                    <option <?php print($view_education['graduation_id']==$graduation['graduation_id'] ?'selected="selected"': "") ?> value="<?php echo $graduation['graduation_id']; ?>">
                      <?php echo $graduation['graduation_name']; ?></option>
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
                    foreach($view_specialization as $specialization)
                    {
                      ?>
                      <option <?php print($view_education['specialization_id']==$specialization['specialization_id'] ?'selected="selected"': "") ?> value="<?php echo $specialization['specialization_id']; ?>"><?php echo $specialization['specialization_name']; ?></option>
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

                    <?php
                    echo '<select name="graduationyear" id="selectElementId" class="form-control">';
                    for($i=1960;$i<=date("Y");$i++) {
                      echo '<option value="$i">$i</option>';
                    }
                    echo "</select>";
                    ?>
                  </div>
                  <?php// print($view_education['university_year']=="" ?"":'$("#selectElementId option[value=\' 'echo $view_education['university_year'];' \']").attr("selected","selected");') ?>

                  <div class="form-group">
                    <label>Grading System</label>
                    <select id="gradingsystem" class="form-control" name="gradingsystem">
                      <option value="" <?php print($view_education['grading_system']=="" ?'selected="selected"': "") ?>>Select Grading System</option>
                      <option value="10 Grading System" <?php print($view_education['grading_system']=="10 Grading System" ?'selected="selected"': "") ?>>Select 10 Grading System</option>
                      <option value="4 Grading System" <?php print($view_education['grading_system']=="4 Grading System" ?'selected="selected"': "") ?>>Select 4 Grading System</option>
                      <option value="100 Grading System" <?php print($view_education['grading_system']=="100 Grading System" ?'selected="selected"': "") ?>>% Marks of 100 Maximum</option>
                      <option value="Pass" <?php print($view_education['grading_system']=="Pass" ?'selected="selected"': "") ?>>Course Requires a Pass</option>
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
                    <select id="xboard" class="form-control" name="xboard">
                      <option value="" <?php print($view_education['x_board']=="" ?'selected="selected"': "") ?>>Select Board</option>
                      <option value="CBSE" <?php print($view_education['x_board']=="CBSE" ?'selected="selected"': "") ?>>CBSE</option>
                      <option value="CISCE" <?php print($view_education['x_board']=="CISCE" ?'selected="selected"': "") ?>>CISCE(ICSE/ISC)</option>
                      <option value="DIPLOMA" <?php print($view_education['x_board']=="DIPLOMA" ?'selected="selected"': "") ?>>DIPLOMA</option>
                      <option value="StateBoard" <?php print($view_education['x_board']=="StateBoard" ?'selected="selected"': "") ?>>STATE BOARD</option>
                      <option value="NationalOpenSchool" <?php print($view_education['x_board']=="NationalOpenSchool" ?'selected="selected"': "") ?>>National Open School</option>
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
                      <option value="" <?php print($view_education['xii_board']=="" ?'selected="selected"': "") ?>>Select Board</option>
                      <option value="CBSE" <?php print($view_education['xii_board']=="CBSE" ?'selected="selected"': "") ?>>CBSE</option>
                      <option value="CISCE" <?php print($view_education['xii_board']=="CISCE" ?'selected="selected"': "") ?>>CISCE(ICSE/ISC)</option>
                      <option value="DIPLOMA" <?php print($view_education['xii_board']=="DIPLOMA" ?'selected="selected"': "") ?>>DIPLOMA</option>
                      <option value="STATEBOARD" <?php print($view_education['xii_board']=="STATEBOARD" ?'selected="selected"': "") ?>>STATE BOARD</option>
                      <option value="NationalOpenSchool" <?php print($view_education['xii_board']=="NationalOpenSchool" ?'selected="selected"': "") ?>>National Open School</option>
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
