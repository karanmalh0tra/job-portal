<?php
session_start();

if(!$_SESSION['company_email'])
{
  header("Location: companylogin.php");
}
else {
  require_once "class/user-service.php";
  $userService = new UserService();
  $jobId = $_GET['jobId'];

  $companyId = $_SESSION['company_id'];
  require_once "class/company-service.php";
  $companyService = new CompanyService();
  $view_applications = $companyService->viewApplications($jobId);
  $view_job_from_company = $companyService->viewJobFromCompany($companyId);
  $get_job_detail = $companyService->getJobDetail($jobId);
  $updateCompanyNotifications = $companyService->updateCompanyNotifications($jobId);
  $appnotif = $companyService->viewCompanyNotification($_SESSION['company_id']);

}

?>

<?php include "header.php";?>




<!-- =============== Start of Page Header 1 Section =============== -->
<section class="page-header">
  <div class="container">

    <!-- Start of Page Title -->
    <div class="row">
      <div class="col-md-12">
        <h2>Applications for <?php echo $get_job_detail['job_title']; ?></h2>
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

        <table border="1px solid black">
          <caption>Users Applied for the Job</caption>
          <tr>
            <th>User Name</th>
            <th>Mobile Number</th>
            <th>Email</th>
            <th>Resume Headline</th>
            <th>Profile Summary</th>
            <th>Key Skills</th>
            <th>Action</th>
          </tr>
          <?php foreach($view_applications as $jobsfromcompany)
          {
            $view_users = $userService->viewUser($jobsfromcompany['user_id']);
            ?>
            <tr>
              <td><?php echo $view_users['user_name']; ?></td>
              <td><?php echo $view_users['user_mobile']; ?></td>
              <td><?php echo $view_users['user_email']; ?></td>
              <td><?php echo $view_users['resume_headline']; ?></td>
              <td><?php echo $view_users['profile_summary']; ?></td>
              <td><?php echo $view_users['user_key_skills']; ?></td>
              <td><p><a href="controller/shortlistapplicant.php?userId=<?php echo $view_users['user_id']; ?>&jobId=<?php echo $jobId; ?>">Shortlist</a></p>
                <p><a href="controller/acceptapplicant.php?userId=<?php echo $view_users['user_id']; ?>&jobId=<?php echo $jobId; ?>">Accept</a></p>
                <p><a href="controller/rejectapplicant.php?userId=<?php echo $view_users['user_id']; ?>&jobId=<?php echo $jobId; ?>">Reject</a></p>
              </td>
            </tr>
            <?php } ?>
          </table>


        </div>
        <!-- End of Blog Posts -->


        <!-- Start of Blog Sidebar -->
        <div class="col-md-4 col-md-pull-8 col-xs-12 blog-sidebar">

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
