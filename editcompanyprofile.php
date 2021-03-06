<?php
session_start();

if(!$_SESSION['company_email'])
{
  header("Location: companylogin.php");
}
else {
  $companyId = $_SESSION['company_id'];
  require_once "class/company-service.php";
  $companyService = new CompanyService();
  $view_company = $companyService->viewCompany($companyId);
  $appnotif = $companyService->viewCompanyNotification($_SESSION['company_id']);
}

?>

<?php include "header.php";?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>

<script>
$(document).ready(function(){
  jQuery.noConflict()(function(){
    $("#mycompanyform").validate({
      rules: {
        company_name: {
          required: true
        },
        company_about: {
          required: true
        },
        company_address: {
          required: true
        },
        location: {
          required: true
        },
        company_contact: {
          required: true,
          digits: true,
          minlength: 10,
          maxlength: 10
        },
        company_contact_person: {
          required: true
        }
      },
      messages: {
        company_name: {
          required: "Please enter Company Name"
        },
        company_about: {
          required: "tell us something about the Company"
        },
        company_address: {
          required: "Please enter the address of the Company"
        },
        location: {
          required: "Please enter the location of your company"
        },
        company_contact: {
          required: "Please enter company's contact number",
          digits: "Please only enter numbers",
          minlength: "Enter a 10 digit mobile number",
          maxlength: "ENter a 10 digit mobile number"
        },
        company_contact_person: {
          required: "Please enter your name"
        }
      }
    });
  });
});
</script>

<style>

#mycompanyform label.error, #mycompanyform input.submit {

  color:red;
}
</style>


<!-- =============== Start of Page Header 1 Section =============== -->
<section class="page-header">
  <div class="container">

    <!-- Start of Page Title -->
    <div class="row">
      <div class="col-md-12">
        <h2>blog - left sidebar ver.1</h2>
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
        <form name="mycompanyform" id="mycompanyform" class="post-job-resume mt50" action="controller/editcompanyprofile.php?companyId=<?php echo $companyId; ?>" method="post" enctype="multipart/form-data">

          <!-- Start of Resume Details -->
          <div class="row">
            <div class="col-md-12">

              <!-- Form Group -->
              <div class="form-group">
                <label>company name</label>
                <input class="form-control" id="company_name" type="text" name="company_name" value="<?php echo $view_company['company_name']; ?>" required/>
              </div>

              <!-- Form Group -->
              <div class="form-group">
                <label>About the Company</label>
                <textarea id="company_about" class="form-control" name="company_about" rows="4" cols="50"><?php echo $view_company['company_about']; ?></textarea>
              </div>

              <!-- Form Group -->
              <div class="form-group">
                <label>company address</label>
                <textarea id="company_address" class="form-control" name="company_address" rows="2" cols="50" required><?php echo $view_company['company_address']; ?></textarea>
              </div>

              <!-- Form Group -->
              <div class="form-group">
                <label>location</label>
                <input id="location" class="form-control" type="text" name="location" value="<?php echo $view_company['company_location']; ?>" required/>
              </div>

              <!-- Form Group -->
              <div class="form-group">
                <label>Company Contact</label>
                <input id="company_contact" class="form-control" type="text" name="company_contact" value="<?php echo $view_company['company_contact']; ?>" required/>
              </div>

              <!-- Form Group -->
              <div class="form-group">
                <label>Company Contact Person</label>
                <input id="company_contact_person" class="form-control" type="text" name="company_contact_person" value="<?php echo $view_company['company_contact_person']; ?>" required/>
              </div>

              <!-- Form Group -->
              <div class="form-group">
                <label>company logo <span>(optional)</span></label>

                <!-- Upload Button -->
                <div class="upload-file-btn">
                  <span><i class="fa fa-upload"></i> Upload</span>
                  <input type="file" name="newimage" accept=".jpg,.png,.gif">
                  <input type="hidden" name="oldimage" value="<?php echo $view_company['imagepath']; ?>">
                </div>
                <img class="form-control" src="<?php echo $view_company['imagepath']; ?>" alt="No Logo Uploaded">
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
          <h4 class="widget-title">Company Profile</h4>
          <ul class="sidebar-list">
            <li><a href="">Company Profile</a></li>
          </ul><br/><br/><br/>
          <h4 class="widget-title">Jobs</h4>
          <ul class="sidebar-list">
            <li><a href="postedjobs.php">Posted Jobs</a></li>
            <li><a href="">Package Details</a></li>
            <li><a href="">Resume Search</a></li>
          </ul><br/><br/><br/>
          <h4 class="widget-title">Manage Jobs</h4>
          <ul class="sidebar-list">
            <li><a href="postjob.php">Post a Job</a></li>
            <li><a href="modifyjob.php">Modify Jobs</a></li>
          </ul><br/><br/><br/>
          <h4 class="widget-title">Manage Applications</h4>
          <ul class="sidebar-list">
            <li><a href="viewapplications.php">View Applications <?php echo $appnotif['count'];?></a></li>
            <li><a href="">View Candidate Profile</a></li>
            <li><a href="">Reply Candidate via Email</a></li>
            <li><a href="">Save Profile</a></li>
          </ul><br/><br/><br/>
          <h4 class="widget-title">Saved Profiles</h4>
          <ul class="sidebar-list">
            <li><a href="viewshortlisted.php">View Candidate &amp; Profile</a></li>
            <li><a href="">Reply Candidate via Email</a></li>
            <li><a href="">Remove from Saved Listing</a></li>
          </ul><br/><br/><br/>
          <h4 class="widget-title">Account Settings</h4>
          <ul class="sidebar-list">
            <li><a href="editcompanyprofile.php">Edit Profile</a></li>
            <li><a href="changecompanypassword.php">Change Password</a></li>
          </ul>
        </ul><br/><br/><br/>
        <h4 class="widget-title">Buy Package</h4>
        <ul class="sidebar-list">
          <li><a href="">Free</a></li>
          <li><a href="">Starter</a></li>
          <li><a href="">Premium</a></li>
        </ul><br/><br/><br/>
      </div>
      <!-- End of Categories -->


    </div>
    <!-- End of Blog Sidebar -->

  </div>
</div>
</section>
<!-- ===== End of Blog Listing Section ===== -->





<!-- ===== Start of Get Started Section ===== -->
<section class="get-started ptb40">
  <div class="container">
    <div class="row ">

      <!-- Column -->
      <div class="col-md-10 col-sm-9 col-xs-12">
        <h3 class="text-white">20,000+ People trust Cariera! Be one of them today.</h3>
      </div>

      <!-- Column -->
      <div class="col-md-2 col-sm-3 col-xs-12">
        <a href="https://themeforest.net/item/cariera-job-board-html-template/19568206?ref=gnodesign" target="_blank" class="btn btn-blue btn-effect">get start now</a>
      </div>

    </div>
  </div>
</section>
<!-- ===== End of Get Started Section ===== -->




<?php include "footer.php";?>
