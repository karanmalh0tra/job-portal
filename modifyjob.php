<?php
session_start();

if(!$_SESSION['company_email'])
{
  header("Location: companylogin.php");
}
else {
  $companyId = $_SESSION['company_id'];
  require_once "class/company-service.php";
  require_once "class/user-service.php";
  $companyService = new CompanyService();
  $userService = new UserService();
  $view_job = $companyService->viewJobFromCompany($companyId);
  $view_industry=$userService->viewIndustry();
  $view_functionalarea=$userService->viewFunctionalArea();
}

?>

<?php include "header.php";?>
<script>
jQuery(document).ready(function(){

  jQuery.noConflict()(function(){
    //alert("hi");
    $(document).on("click",".status",function(){

      var jobId = $(this).attr("id");
      //		alert("hi"+reviewId);
      var this_ref = this;
      $.ajax({
        url:"controller/editjobstatus.php",
        type:"GET",
        data:"jobId="+jobId,
        success: function(response)
        {
          alert(response);
          if(response =="inactive"){
            $(this_ref).html(response).wrapInner('<span class="btn btn-warning"></span>');
            $(this_ref).parent().parent().attr("style","background:#f1d4d9;");
            $(this_ref).removeClass("status").addClass("status");
          }else{
            $(this_ref).html(response).wrapInner('<span class="btn btn-success"></span>');
            $(this_ref).parent().parent().attr("style","background:#d4f1d4;");
            $(this_ref).removeClass("status").addClass("status");
          }
        }
      });
    });
  });
});
</script>



<!-- =============== Start of Page Header 1 Section =============== -->
<section class="page-header">
  <div class="container">

    <!-- Start of Page Title -->
    <div class="row">
      <div class="col-md-12">
        <h2>Modify Jobs</h2>
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
        <table border="1px solid black" style="width:120%;">
          <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Work Experience</th>
            <th>Skills</th>
            <th>Salary</th>
            <th>Location</th>
            <th>Industry</th>
            <th>Functional Area</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          <?php foreach($view_job as $jobs)
          {?>
            <tr>
              <td><?php echo $jobs['job_title']; ?></td>
              <td><?php echo $jobs['job_description']; ?></td>
              <td><?php echo $jobs['job_work_experience']; ?></td>
              <td><?php echo $jobs['job_skills']; ?></td>
              <td><?php echo $jobs['job_salary']; ?></td>
              <td><?php echo $jobs['job_location']; ?></td>
              <td><?php echo $jobs['industry_id']; ?></td>
              <td><?php echo $jobs['functionalarea_id']; ?></td>
              <td ><a class="status" id="<?php echo $jobs['job_id']; ?>"><?php if(($jobs['job_status'] == 'active')){ echo "<span class='btn btn-success'>active</span>";}else{echo "<span class='btn btn-warning'>inactive</span>";} ?></a></td>
              <td><a href="editjob.php?jobId=<?php echo $jobs['job_id']; ?>">Edit</a>
                <a href="controller/deletejob.php?jobId=<?php echo $jobs['job_id'] ?>"><span onclick="return confirm('Are you sure you want to Delete?')">delete</span></a>
              </td>
            </tr>
            <?php
          }?>
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
            <li><a href="modifyjob.php">Edit &#47; Delete Jobs</a></li>
            <li><a href=""></a></li>
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
