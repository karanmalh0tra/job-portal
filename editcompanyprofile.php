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
}

?>

<?php include "header.php";?>



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
          <li class="active">blog</li>
          <li class="active">blog - left sidebar</li>
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
              <label>company logo <span>(optional)</span></label>

              <!-- Upload Button -->
              <div class="upload-file-btn">
                <span><i class="fa fa-upload"></i> Upload</span>
                <input type="file" name="newimage" accept=".jpg,.png,.gif">
                <input type="hidden" name="oldimage" value="<?php echo $view_company['imagepath']; ?>">
              </div>
              <img class="form-control" src="<?php echo $view_user['imagepath']; ?>" alt="No Logo Uploaded">
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
          <li><a href="">Edit Jobs</a></li>
          <li><a href="">Delete Jobs</a></li>
          <li><a href="">Activate and Deactivate Jobs</a></li>
        </ul><br/><br/><br/>
        <h4 class="widget-title">Manage Applications</h4>
        <ul class="sidebar-list">
          <li><a href="">View Applications</a></li>
          <li><a href="">View Candidate Profile</a></li>
          <li><a href="">Reply Candidate via Email</a></li>
          <li><a href="">Save Profile</a></li>
        </ul><br/><br/><br/>
        <h4 class="widget-title">Saved Profiles</h4>
        <ul class="sidebar-list">
          <li><a href="">View Candidate &amp; Profile</a></li>
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
