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
  $skills = $_GET['skills'];
  $location = $_GET['location'];
  $view_searched_employees = $companyService->searchEmployees($skills,$location);
}

?>

<?php include "header.php";?>



<!-- =============== Start of Page Header 1 Section =============== -->
<section class="page-header">
  <div class="container">

    <!-- Start of Page Title -->
    <div class="row">
      <div class="col-md-12">
        <h2>Search Employees</h2>
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
          <tr>
            <th>Name</th>
            <th>Location</th>
            <th>Skills</th>
            <th>Gender</th>
          </tr>
        <?php
        foreach($view_searched_employees as $employees)
        { ?>
            <tr>
              <td><?php echo $employees['user_name']; ?></td>
              <td><?php echo $employees['user_location']; ?></td>
              <td><?php echo $employees['user_key_skills']; ?></td>
              <td><?php echo $employees['user_gender']; ?></td>
            </tr>
          <?php }?>
        </table>

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


<?php include "footer.php";?>
