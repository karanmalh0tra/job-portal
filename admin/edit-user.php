<?php
@session_start();

if(!isset($_SESSION['admin_email'])){

  echo "<script>window.open('login.php','_self')</script>";
}
else {

  ?>
  <?php include "header.php" ; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"> </script>
  <script>

  // When the browser is ready...
  $(document).ready(function(){
    //  jQuery.noConflict()(function(){
    // Setup form validation on the #register-form element
    $("#userForm").validate({

      // Specify the validation rules
      rules: {
        name: "required",
        mobile: {
          required: true,
          minlength: 10,
          maxlength: 10,
          digits: true
        },
        emailId: {
          required: true,
          email: true
        },
        address: {
          required: true
        },
        person: {
          required: true
        }
      },
      // Specify the validation error messages
      messages: {
        name: "Please Enter Name.",
        mobile: {
          required: "Please Enter  Mobile Number.",
          minlength: "Please Enter 10 Digit Mobile Number.",
          maxlength: "Please Enter 10 Digit Mobile Number.",
          digits: "Please Enter Number Only."
        },
        emailId: {
          required: "Please Enter Email Id.",
          email: "Please Enter Valid Email Id."
        },
        address: {
          required: "Please Enter The Address."
        },
        person: {
          required: "Please Enter The Name ."
        }
      }

    });
    //});
  });

  </script>

  <style>

  #userForm label.error, #userForm input.submit {

    color:red;
  }
  </style>
  <?php
  $userId = $_GET['userId'];
  require_once 'class/admin-service.php';
  $adminService = new AdminService();
  $getUser = $adminService->getUserById($userId);
  ?>
  <div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="tip-bottom">Edit User</a></div>
      <h1>Edit User</h1>

    </div>
    <div class="container-fluid">
      <hr>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Edit User Detail</h5>
            </div>
            <div class="widget-content nopadding">
              <form name="userForm" id="userForm" method="Post" action="controller/edit-user.php?userId=<?php echo $_GET['userId']; ?>" class="form-horizontal">
                <div class="control-group">
                  <label class="control-label">Name :</label>
                  <div class="controls">
                    <input type="text" value="<?php echo $getUser['user_name'];?>" name="name" id="name" class="span11" placeholder="Enter Name Here." required/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Resume Headline :</label>
                  <div class="controls">
                    <textarea name="resume" id="resume" rows="2" cols="80" required/><?php echo $getUser['resume_headline'];?></textarea>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Mobile Number :</label>
                  <div class="controls">
                    <input type="text" value="<?php echo $getUser['user_mobile'];?>" name="mobile" id="mobile" class="span11" placeholder="Enter Mobile Number Here." required/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Email Id :</label>
                  <div class="controls">
                    <input type="email" value="<?php echo $getUser['user_email'];?>" name="emailId" id="emailId" class="span11" placeholder="Enter Email Id Here." required/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Address :</label>
                  <div class="controls">
                    <input type="text" value="<?php echo $getUser['address'];?>" name="address" id="address" class="span11" placeholder="Enter Address Here." required/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Date of Birth :</label>
                  <div class="controls">
                    <input type="date" value="<?php echo $getUser['date_of_birth'];?>" name="dob" id="dob" class="span11" placeholder="Enter D.O.B. Here." required/>
                  </div>
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-success">Save</button>
                </div>
              </form>
            </div>
          </div>


        </div>

      </div>

    </div></div>

    <?php include "footer.php" ; ?>
    <?php } ?>
