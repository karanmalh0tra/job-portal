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
  
    // Setup form validation on the #register-form element
    $("#profileForm").validate({
    
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
            }
           
        }
        
    });

  });
  
  </script>
	
	<style>
	
	#profileForm label.error, #profileForm input.submit {
		
		color:red;
	}
	</style>
<?php
//$adminId = $_GET['adminId'];
require_once 'class/admin-service.php';
$adminService = new AdminService();
$getAdmin = $adminService->getAdminById($_SESSION['admin_id']);
?>
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="tip-bottom">Profile Update</a></div>
  <h1>Profile Update</h1>
		<?php if(isset($_GET['success'])){
							              if($_GET['success']==0){  ?>				
										  
										<?php	echo '<center><b style="color:red;"><span>Profile  Not Updatted .Please Try Again.</span></b></center>'; ?>
																		
											<?php } elseif($_GET['success']==1){ ?>
											
											<?php	echo '<h3><center><b style="color:green;"><span>Profile Updatted Successfully.</span></b></center></h3>'; ?>
															
								<?php }} ?>				    	
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Update Profile Details</h5>
        </div>
        <div class="widget-content nopadding">
          <form name="profileForm" id="profileForm" method="Post" action="controller/update-profile.php?adminId=<?php echo $_SESSION['admin_id']; ?>" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Name :</label>
              <div class="controls">
                <input type="text" value="<?php echo $getAdmin['admin_name'];?>" name="name" id="name" class="span11" placeholder="Enter Name Here." />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Mobile Number :</label>
              <div class="controls">
                <input type="text" value="<?php echo $getAdmin['admin_mobile'];?>" name="mobile" id="mobile" class="span11" placeholder="Enter Mobile Number Here." />
              </div>
            </div>
			<div class="control-group">
              <label class="control-label">Email Id :</label>
              <div class="controls">
                <input type="email" value="<?php echo $getAdmin['admin_email'];?>" name="emailId" id="emailId" class="span11" placeholder="Enter Email Id Here." />
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
