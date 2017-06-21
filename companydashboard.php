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



<!-- =============== Start of Page Header 1 Section =============== -->
<section class="page-header">
  <div class="container">

    <!-- Start of Page Title -->
    <div class="row">
      <div class="col-md-12">
        <h2>company dashboard</h2>
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
    <div class="form-group">
      <form name="searchemployeeform" id="searchemployeeform" class="mt-50" action="searchemployees.php" method="get" >
        <label><h6>Skills:</h6></label><textarea name="skills" rows="1" cols="20" style="color:black;"></textarea>
        <label><h6>Location:</h6></label><textarea name="location" rows="1" cols="20" style="color:black;"></textarea>
        <button type="submit" class="btn btn-blue btn-effect">search</button>
      </form>
    </div>

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
        <article class="col-md-12 blog-post">



          <!-- Blog Post Description -->
          <div class="col-md-8 blog-desc">
            <h5><a href="blog-post-right-sidebar.html">top 10 tips for web developers</a></h5>
            <div class="post-detail pt10 pb20">
              <span><i class="fa fa-user"></i>Author</span>
              <span><i class="fa fa-clock-o"></i>4:30</span>
              <span><i class="fa fa-comments-o"></i>12 Comments</span>
            </div>

            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book....</p>
            <a href="blog-post-right-sidebar.html" class="btn btn-blue btn-effect mt10">read more</a>
          </div>
        </article>
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


<?php include "footer.php";?>
