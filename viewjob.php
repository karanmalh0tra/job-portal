<?php
session_start();
?>
<?php
//require_once "class/user-service.php";
require_once "class/company-service.php";
$companyService = new CompanyService();
$view_job = $companyService->viewJob();



?>

<?php include "header.php";?>


<section class="ptb80" id="job-post">
  <div class="container">

    <!-- Start of Job Post Main -->
    <div class="col-md-8 col-sm-12 col-xs-12 job-post-main">
      <h2 class="capitalize"><i class="fa fa-briefcase"></i>latest jobs</h2>

      <!-- Start of Job Post Wrapper -->
      <div class="job-post-wrapper mt60">

        <!-- Start of Single Job Post 1 -->
        <?php
        foreach($view_job as $job)
        {
          //if(isset($_SESSION['user_id'])){

          //  }




          ?>
          <div class="single-job-post row nomargin">
            <!-- Job Company -->
            <div class="col-md-2 col-xs-3 nopadding">
              <div class="job-company">
                <a href="company-page-1.html">
                  <img src="images/companies/envato.svg" alt="">
                </a>
              </div>
            </div>

            <!-- Job Title & Info -->
            <div class="col-md-8 col-xs-6 ptb20">
              <div class="job-title">
                <a href="job-page.html"><?php echo $job['job_title']; ?></a>
              </div>

              <div class="job-info">
                <span class="company"><i class="fa fa-building-o"></i><?php
                $view_company = $companyService->viewCompanyById($job['company_id']);
                echo $view_company['company_name'];
                ?></span>
                <span class="location"><i class="fa fa-map-marker"></i><?php echo $job['job_location']; ?></span>
              </div>
            </div>

            <!-- Job Category -->
            <div class="col-md-2 col-xs-3 ptb30">
              <div class="job-category" id="applied">
                <a href="job-detail.php?jobId=<?php echo $job['job_id']; ?>" class="btn btn-green btn-small btn-effect">details</a>
                <?php
                if(!empty($_SESSION['user_id'])) {
                  $applied_job = $companyService->appliedJobs($_SESSION['user_id'],$job['job_id']);
                  if(!empty($applied_job)){
                    if(!empty($applied_job['status'])){ ?>
                      <span class='btn btn-success'> applied </span>
                      <?php    } } }else {  ?>

                        <a class="jobStatus" id="<?php echo $job['job_id']; ?>">

                          <span class='btn btn-warning'>apply</span>
                        </a>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                  <!-- End of Single Job Post 1 -->
                  <?php }  ?>


                </div>
                <!-- End of Job Post Wrapper -->

              </div>
              <!-- End of Job Post Main -->


              <!-- Start of Job Post Sidebar -->
              <div class="col-md-4 col-xs-12 job-post-sidebar">
                <h2 class="capitalize"><i class="fa fa-star"></i>golden jobs</h2>

                <!-- Start of Featured Job Widget -->
                <div class="featured-job widget mt60">

                  <!-- Start of Company Logo -->
                  <div class="company">
                    <img src="images/companies/cloudify.svg" alt="">
                  </div>
                  <!-- End of Company Logo -->

                  <!-- Start of Featured Job Info -->
                  <div class="featured-job-info">

                    <!-- Job Title -->
                    <div class="job-title">
                      <h5 class="uppercase pull-left">ui designer</h5>
                      <a href="javascript:void(0)" class="btn btn-green btn-small btn-effect pull-right">full time</a>
                    </div>

                    <!-- Job Info -->
                    <div class="job-info pt5">
                      <span id="company"><i class="fa fa-building-o"></i>cloudify</span>
                      <span id="location"><i class="fa fa-map-marker"></i>london, uk</span>
                    </div>

                    <p class="mt20"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>

                    <!-- View Job Button -->
                    <div class="text-center mt20">
                      <a href="job-page.html" class="btn btn-purple btn-small btn-effect">view job</a>
                    </div>
                  </div>
                  <!-- End of Featured Job Info -->

                </div>
                <!-- End of Featured Job Widget -->

              </div>
              <!-- End of Job Post Sidebar -->

            </div>
          </section>
          <!-- ===== End of Job Post Section ===== -->


          <?php include "footer.php";?>
          <script>
          $(document).on("click",".jobStatus",function(){
            var jobId = $(this).attr('id');
            var this_ref = this;
            var str="jobId="+jobId;

            $.ajax({
              type: "GET",
              data: str,
              url: 'controller/applyforjob.php',
              cache: false,
              success: function(response) {
                if(response == -1) {
                  alert("Please Log In");
                }
                else {
                  $(this_ref).html(response).wrapInner('<span class="btn btn-success">applied</span>');
                  $(this_ref).removeClass("jobStatus");
                  $(this_ref).$('#applied').load('viewjob.php #applied');
                }
              }
            });

          });
          </script>
