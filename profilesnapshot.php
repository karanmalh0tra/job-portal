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

<div class="container">
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
            <div class="form-group">
                <label>resume headline</label>
                <textarea id="resume_headline" class="form-control" name="resume_headline" rows="4" cols="50" placeholder="none">
                  <?php echo $view_user['resume_headline']; ?>
                </textarea>
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
                <label>permanent address</label>
                <textarea id="address" class="form-control" name="address" rows="3" cols="50" placeholder="none">
                  <?php echo $view_user['address']; ?>
                </textarea>
            </div>

            <!-- Form Group -->
            <div class="form-group">
                <label>home town/city</label>
                <textarea id="hometown" class="form-control" name="hometown" rows="1" cols="20" placeholder="none">
                  <?php echo $view_user['hometown']; ?>
                </textarea>
            </div>

            <!-- Form Group -->
            <div class="form-group">
                <label>pincode</label>
                <textarea id="pincode" class="form-control" name="pincode" rows="1" cols="20" placeholder="none">
                  <?php echo $view_user['pincode']; ?>
                </textarea>
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
                                 <option value="M" <?php print($view_user['marital_status']=="M" ?'selected="selected"': "") ?> >Married</option>
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
                <img class="form-control" src="<?php echo $view_user['imagepath']; ?>" alt="No photo uploaded">
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
<!-- End of Post Resume Form -->
</div>


  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSkE7G79EbUYf0YA7ikEnCPGwKiDTiMkU&libraries=places&callback=initMap"async defer></script>

  <script>
  function initMap() {
    var input = document.getElementById('location');
    var autocomplete = new google.maps.places.Autocomplete(input);
  }
  </script>


  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js"></script>
  <script>
  jQuery.noConflict();
    jQuery(document).ready(function() {
       jQuery("#functionalarea").change(function() {
         //alert( $(this).val());
         jQuery(this).after('<div id="loader"><img src="img/loading.gif" alt="loading subcategory" /></div>');
         $.get('controller/loadsubcat.php?functionalarea=' + jQuery(this).val(), function(data) {
           jQuery("#role").html(data);
           jQuery('#loader').slideUp(200, function() {
             jQuery(this).remove();
           });
          });
        });

    });
  </script>



<?php include "footer.php";?>
