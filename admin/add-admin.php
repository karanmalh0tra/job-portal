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
    $("#adminForm").validate({
    
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
			password: { 
				 required: true,
				 minlength: 5
			
			},
			confirmPassword: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				},
				role: {required: true } 
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
			password: {
                required: "Please Enter Password.",
                minlength: "Password Minimum Length is 5."
            },
           confirmPassword: {
                required: "Please Enter Confirm Password.",
                minlength: "Password Minimum Length is 5.",
				equalTo: "Password Does Not Matched"
            },
			role: {required: "Please Select User Role." } 
          
        }
        
    });
 //});
  });
  
  </script>
	
	<style>
	
	#adminForm label.error, #adminForm input.submit {
		
		color:red;
	}
	</style>
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="tip-bottom">Add Admin</a></div>
  <h1>Add New Admin</h1>
						    	<?php if(isset($_GET['success'])){
							              if($_GET['success']==0){  ?>				
										  
										<?php	echo '<h4><center><b style="color:red;"><span>Admin Detail Not Added .Please Try Again.</span></b></center></h4>'; ?>
																		
											<?php } elseif($_GET['success']==1){ ?>
											
											<?php	echo '<h4><center><b style="color:green;"><span>Admin Detail Added Successfully.</span></b></center></h4>'; ?>
															
								<?php }} ?>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>New Admin Detail</h5>
        </div>
        <div class="widget-content nopadding">
          <form name="adminForm" id="adminForm" method="Post" action="controller/add-admin.php" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Name :</label>
              <div class="controls">
                <input type="text" name="name" id="name" class="span11" placeholder="Enter Name Here." required/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Mobile Number :</label>
              <div class="controls">
                <input type="text" name="mobile" id="mobile" class="span11" placeholder="Enter Mobile Number Here." required/>
              </div>
            </div>
			<div class="control-group">
              <label class="control-label">Email Id :</label>
              <div class="controls">
                <input type="email" name="emailId" id="emailId" class="span11" placeholder="Enter Email Id Here." required/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Password</label>
              <div class="controls">
                <input type="password" name="password" id="password" class="span11" placeholder="Enter Password Here." required />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Confirm Password</label>
              <div class="controls">
                <input type="password"  name="confirmPassword" id="confirmPassword" class="span11" placeholder="Enter Confirm Password Here." required />
              </div>
            </div>
			 <div class="control-group">
              <label class="control-label">Select Role</label>
              <div class="controls">
			  
                <select class="span11" name="role" id="role" required>
                     <option value="">-- Select Role --</option>
                     <option value="Admin">Admin</option>
					 <option value="Sub-Admin">Sub-Admin</option>
                </select>
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
