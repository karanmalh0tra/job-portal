<?php
session_start();

if(!$_SESSION['company_email'])
{
  header("Location: companylogin.php");
}
else {
  $companyId = $_SESSION['company_id'];
  $jobId = $_GET['jobId'];
  require_once "class/company-service.php";
  require_once "class/user-service.php";
  $companyService = new CompanyService();
  $userService = new UserService();
  $view_job = $companyService->getJobDetail($jobId);
  $view_company = $companyService->viewCompany($companyId);
  $view_industry=$userService->viewIndustry();
  $view_functionalarea=$userService->viewFunctionalArea();
}

?>

<?php include "header.php";?>



<!-- =============== Start of Page Header 1 Section =============== -->
<section class="page-header">
  <div class="container">

    <!-- Start of Page Title -->
    <div class="row">
      <div class="col-md-12">
        <h2>Post Job</h2>
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
        <!-- Form -->
        <form class="" id="jobform" name="jobform" action="controller/editjob.php?jobId=<?php echo $jobId; ?>" method="post">

          <!-- Form Group -->
          <div class="form-group">
            <label>Job Title</label>
            <input type="text" id="jobtitle" name="jobtitle" class="form-control" placeholder="Enter Job Title" value="<?php echo $view_job['job_title']; ?>"required/ >
          </div>

          <!-- Form Group -->
          <div class="form-group">
            <label>Job Description</label>
            <!-- //TODO: add a text editor -->
            <input type="text" id="jobdescription" name="jobdescription" class="form-control" placeholder="Enter Job Description" value="<?php echo $view_job['job_description']; ?>" required/>

          </div>
          <!-- <textarea id="elm1" name="description" cols="50" rows="12" class="form-control ng-invalid ng-invalid-required"></textarea> -->
          <!-- Form Group -->
          <div class="form-group">
            <label>Experience Required</label>
            <select class="form-control" name="jobexperience" id="jobdexperience">
              <<option value="" selected>Select Years</option>
              <option value="1" <?php print($view_job['job_work_experience']=="1" ?'selected="selected"': "") ?>>1</option>
              <option value="2" <?php print($view_job['job_work_experience']=="2" ?'selected="selected"': "") ?>>2</option>
              <option value="3" <?php print($view_job['job_work_experience']=="3" ?'selected="selected"': "") ?>>3</option>
              <option value="4" <?php print($view_job['job_work_experience']=="4" ?'selected="selected"': "") ?>>4</option>
              <option value="5" <?php print($view_job['job_work_experience']=="5" ?'selected="selected"': "") ?>>5</option>
              <option value="6" <?php print($view_job['job_work_experience']=="6" ?'selected="selected"': "") ?>>6</option>
              <option value="7" <?php print($view_job['job_work_experience']=="7" ?'selected="selected"': "") ?>>7</option>
            </select>
          </div>

          <!-- Form Group -->
          <div class="form-group mb30">
            <label>Skills Required</label>
            <textarea class="form-control" id="jobskills" name="jobskills" rows="1" cols="30"><?php echo $view_job['job_skills']; ?></textarea>
          </div>

          <!-- Form Group -->
          <div class="form-group mb30">
            <label>Salary</label>
            <input type="text" name="jobsalary" id="jobsalary" class="form-control" placeholder="in Rs." value="<?php echo $view_job['job_salary']; ?>" required/>
          </div>

          <!-- Form Group -->
          <div class="form-group mb30">
            <label>Location</label>
            <input type="text" name="joblocation" id="joblocation" class="form-control" placeholder="Enter Job Location" value="<?php echo $view_job['job_location']; ?>" required/>
          </div>

          <!-- Form Group -->
          <div class="form-group">
              <label>industry</label>
              <select id="jobindustry" class="form-control" name="jobindustry">
                <option value="">Select Industry</option><?php
                foreach($view_industry as $industry)
                {
                  ?>
                  <option value="<?php echo $industry['industry_id']; ?>" <?php print($view_job['industry_id']==$industry['industry_id'] ?'selected="selected"': "") ?>>
                    <?php echo $industry['industry_name']; ?></option>
                  <?php
                }
                ?>
              </select>
          </div>

          <!-- Form Group -->
          <div class="form-group">
              <label>functional area</label>
              <select class="form-control" name="jobfunctionalarea" id="jobfunctionalarea">
                <option value="">Select Functional Area</option><?php
                foreach($view_functionalarea as $functionalarea)
                {
                  ?>
                  <option value="<?php echo $functionalarea['functionalarea_id']; ?>" <?php print($view_job['functionalarea_id']==$functionalarea['functionalarea_id'] ?'selected="selected"': "") ?>>
                    <?php echo $functionalarea['functionalarea_name']; ?></option>
                  <?php
                }
                ?>
              </select>
          </div>

          <!-- Form Group -->
          <div class="form-group text-center nomargin">
            <button type="submit" class="btn btn-blue btn-effect">Edit Job</button>
          </div>

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
