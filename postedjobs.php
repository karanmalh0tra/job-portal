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
  $view_jobs_from_company = $companyService->viewJobFromCompany($companyId);
}

?>

<?php include "header.php";?>



<!-- =============== Start of Page Header 1 Section =============== -->
<section class="page-header">
  <div class="container">

    <!-- Start of Page Title -->
    <div class="row">
      <div class="col-md-12">
        <h2>Posted Jobs</h2>
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
        <?php foreach($view_jobs_from_company as $viewjobs){
           ?>
        <!-- Start of Blog Post Article 1 -->
        <article class="col-md-12 blog-post">



          <!-- Blog Post Description -->
          <div class="col-md-8 blog-desc">
            <h5><a href="blog-post-right-sidebar.html"><?php echo $viewjobs['job_title']; ?></a></h5>
            <br/>
            <p><h6><?php echo $viewjobs['job_description']; ?><h6></p>
            <br/>
            <p><?php echo $viewjobs['job_skills']; ?></p>
            <br/>
            <p><?php echo $viewjobs['timestamp']; ?></p>
            <br/>
          </div>
        </article>
        <?php } ?>
        <!-- End of Blog Post Article 1 -->

        <!-- Start of Pagination -->
        <div class="col-md-12">
          <ul class="pagination list-inline text-center">
            <li class="active"><a href="javascript:void(0)">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">Next</a></li>
          </ul>
        </div>
        <!-- End of Pagination -->

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
            <li><a href="viewapplications.php">View Applications</a></li>
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
