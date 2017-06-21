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
    $("#companyForm").validate({

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

  #companyForm label.error, #companyForm input.submit {

    color:red;
  }
  </style>
  <?php
  $companyId = $_GET['companyId'];
  require_once 'class/admin-service.php';
  $adminService = new AdminService();
  $getCompany = $adminService->getCompanyById($companyId);
  ?>
  <div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="tip-bottom">Edit company</a></div>
      <h1>Edit Company</h1>

    </div>
    <div class="container-fluid">
      <hr>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Edit Company Detail</h5>
            </div>
            <div class="widget-content nopadding">
              <form name="companyForm" id="companyForm" method="Post" action="controller/edit-company.php?companyId=<?php echo $_GET['companyId']; ?>" class="form-horizontal">
                <div class="control-group">
                  <label class="control-label">Name :</label>
                  <div class="controls">
                    <input type="text" value="<?php echo $getCompany['company_name'];?>" name="name" id="name" class="span11" placeholder="Enter Name Here." required/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Person :</label>
                  <div class="controls">
                    <input type="text" value="<?php echo $getCompany['company_contact_person'];?>" name="person" id="person" class="span11" placeholder="Enter Company Contact Person Here." required/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Mobile Number :</label>
                  <div class="controls">
                    <input type="text" value="<?php echo $getCompany['company_contact'];?>" name="mobile" id="mobile" class="span11" placeholder="Enter Mobile Number Here." required/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Email Id :</label>
                  <div class="controls">
                    <input type="email" value="<?php echo $getCompany['company_email'];?>" name="emailId" id="emailId" class="span11" placeholder="Enter Email Id Here." required/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Address :</label>
                  <div class="controls">
                    <input type="text" value="<?php echo $getCompany['company_address'];?>" name="address" id="address" class="span11" placeholder="Enter Address Here." required/>
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
