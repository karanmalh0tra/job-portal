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
    $("#passwordForm").validate({
    
        // Specify the validation rules
       rules: {           
					OldPassword: "required",
					newPassword: "required",
					confirmPassword: {
						required: true,
						equalTo: "#newPassword"
					}		 
				},
				messages: {          
					OldPassword: "Please enter  Old Password.",
					newPassword: "Please enter  New Password.",
					confirmPassword: {
						required: "Please Enter Confirm Password",
						equalTo: "Password Does Not Matched."
					}
				}
    });

  });
  
  </script>
	
	<style>
	
	#passwordForm label.error, #passwordForm input.submit {
		
		color:red;
	}
	</style>
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="#" class="tip-bottom">Change Password</a></div>
  <h1>Change Password</h1>
						    	<?php if(isset($_GET['success'])){
							              if($_GET['success']==0){  ?>				
										  
										<?php	echo '<center><b style="color:red;"><span>Change Password Not Change .Please Try Again.</span></b></center>'; ?>
																		
											<?php } elseif($_GET['success']==1){ ?>
											
											<?php	echo '<h3><center><b style="color:green;"><span>Change Password Change Successfully.</span></b></center></h3>'; ?>
															
								<?php }} ?>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Change Password</h5>
        </div>
        <div class="widget-content nopadding">
          <form name="passwordForm" id="passwordForm" method="Post" action="controller/change-password.php?adminId=<?php echo $_SESSION['admin_id']; ?>" class="form-horizontal">
            
			<div class="control-group">
              <label class="control-label">Old Password</label>
              <div class="controls">
                <input type="password" name="OldPassword" id="OldPassword" class="span11" placeholder="Enter Password Here."  />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">New Password</label>
              <div class="controls">
                <input type="password" name="newPassword" id="newPassword" class="span11" placeholder="Enter Password Here."  />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Confirm Password</label>
              <div class="controls">
                <input type="password"  name="confirmPassword" id="confirmPassword" class="span11" placeholder="Enter Confirm Password Here."  />
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
