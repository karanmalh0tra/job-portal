<?php

require_once "class/user-service.php";
require_once "class/company-service.php";
$companyService = new CompanyService();
$view_job = $companyService->getJobDetail($_GET['jobId']);
$view_all_jobs = $companyService->viewJob();

?>

<?php include "header.php";?>

<!-- ===== Start of Job Header Section ===== -->
<section class="job-header ptb60">
  <div class="container">

    <!-- Start of Row -->
    <div class="row">

      <div class="col-md-6 col-xs-12">
        <h3><?php echo $view_job['job_title']; ?></h3>
        <!--<a href="#" class="btn btn-green btn-small btn-effect mt15">full time</a>-->
      </div>

      <div class="col-md-6 col-xs-12 clearfix">
        <?php
        if(!empty($_SESSION['user_id'])) {
          $saved_job = $companyService->savedJobs($_SESSION['user_id'],$view_job['job_id']);
        if($saved_job['status']=="saved")
        { ?>
          <a class="removeJob pull-right" id="<?php echo $view_job['job_id']; ?>">
            <span class='btn btn-success'>Remove</span>
          </a>
          <?php }
          elseif($saved_job['status']=="unsaved" || empty($saved_job['status'])) { ?>
            <a class="saveJob btn btn-blue btn-effect pull-right mt15" id="<?php echo $view_job['job_id']; ?>">

              <i class="fa fa-star"></i>add to favorites
            </a>
            <?php } } else { ?>
        <a href="#" class="saveJob btn btn-blue btn-effect pull-right mt15"><i class="fa fa-star" id="<?php echo $view_job['job_id']; ?>"></i>add to favorites</a>
        <?php } ?>
      </div>


    </div>
    <!-- End of Row -->

  </div>
</section>
<!-- ===== End of Job Header Section ===== -->





<!-- ===== Start of Main Wrapper Job Section ===== -->
<section class="ptb80" id="job-page">
  <div class="container">

    <!-- Start of Row -->
    <div class="row">

      <!-- ===== Start of Job Details ===== -->
      <div class="col-md-8 col-xs-12">

        <!-- Start of Company Info -->
        <div class="row company-info">

          <!-- Job Company Image -->
          <div class="col-md-3">
            <div class="job-company">
              <a href="company-page.html">
                <img src="images/companies/envato.svg" alt="">
              </a>
            </div>
          </div>

          <!-- Job Company Info -->
          <div class="col-md-9">
            <div class="job-company-info mt30">
              <h3 class="capitalize"><?php
              $view_company = $companyService->viewCompanyById($view_job['company_id']);
              echo $view_company['company_name'];
              ?></h3>

              <ul class="list-inline mt10">
                <li><a href="#"><i class="fa fa-link" aria-hidden="true"></i>Website</a></li>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a></li>
              </ul>
            </div>
          </div>

        </div>
        <!-- End of Company Info -->


        <!-- Start of Job Details -->
        <div class="row job-details mt40">
          <div class="col-md-12">

            <!-- Vimeo Video -->
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/176916362?title=0&amp;byline=0&amp;portrait=0" allowfullscreen=""></iframe>
            </div>

            <!-- Div wrapper -->
            <div class="pt40">
              <h5>Job Overview</h5>

              <p class="mt20"><?php echo $view_job['job_description']; ?></p>
            </div>

            <!-- Div wrapper -->
            <div class="pt40">
              <h5 class="mt40">Key Requirements</h5>

              <!-- Start of List -->
              <ul class="list mt20">
                <?php echo $view_job['job_skills']; ?>
              </ul>
              <!-- End of List -->

            </div>

          </div>
        </div>
        <!-- End of Job Details -->

      </div>
      <!-- ===== End of Job Details ===== -->


      <!-- ===== Start of Job Sidebar ===== -->
      <div class="col-md-4 col-xs-12">

        <!-- Start of Job Sidebar -->
        <div class="job-sidebar">

          <h4 class="uppercase">share this job</h4>

          <!-- Start of Social Media ul -->
          <ul class="social-btns list-inline mt20">
            <!-- Social Media -->
            <li>
              <a href="#" class="social-btn-roll facebook transparent">
                <div class="social-btn-roll-icons">
                  <i class="social-btn-roll-icon fa fa-facebook"></i>
                  <i class="social-btn-roll-icon fa fa-facebook"></i>
                </div>
              </a>
            </li>

            <!-- Social Media -->
            <li>
              <a href="#" class="social-btn-roll twitter transparent">
                <div class="social-btn-roll-icons">
                  <i class="social-btn-roll-icon fa fa-twitter"></i>
                  <i class="social-btn-roll-icon fa fa-twitter"></i>
                </div>
              </a>
            </li>

            <!-- Social Media -->
            <li>
              <a href="#" class="social-btn-roll google-plus transparent">
                <div class="social-btn-roll-icons">
                  <i class="social-btn-roll-icon fa fa-google-plus"></i>
                  <i class="social-btn-roll-icon fa fa-google-plus"></i>
                </div>
              </a>
            </li>
          </ul>
          <!-- End of Social Media ul -->



          <ul class="job-overview nopadding mt40">
            <li>
              <h5><i class="fa fa-calendar"></i> Date Posted:</h5>
              <?php $timestamp = $view_job['timestamp'];
              $datetime = explode(" ",$timestamp);
              $date = $datetime[0];
              $reformatted_date = date('d-m-Y',strtotime($date));
              $time = $datetime[1]; ?>
              <span>Posted on <?php echo $reformatted_date; ?></span>
            </li>

            <li>
              <h5><i class="fa fa-map-marker"></i> Location:</h5>
              <span><?php echo $view_job['job_location']; ?></span>
            </li>

            <li>
              <h5><i class="fa fa-money"></i>Job Salary:</h5>
              <span>Rs. <?php echo $view_job['job_salary']; ?></span>
            </li>

          </ul>
          <!-- //TODO: apply for job -->
          <div class="mt20">
            <?php
            if(!empty($_SESSION['user_id'])) {
              $applied_job = $companyService->appliedJobs($_SESSION['user_id'],$view_job['job_id']);

              if(!empty($applied_job['status'])){ ?>
                <span class='btn btn-success'> applied </span>
                <?php }
                else { ?>
                  <a href="#" class="jobStatus" id="<?php echo $view_job['job_id']; ?>">
                    <span class='btn btn-warning'>apply for job</span>
                  </a>
                  <?php } }else { ?>
                    <a href="#" class="jobStatus" id="<?php echo $view_job['job_id']; ?>">
                      <span class='btn btn-warning'>apply for job</span>
                    </a>
                  <?php }?>
                </div>

              </div>
              <!-- Start of Job Sidebar -->


              <!-- Start of Google Map -->
              <div class="col-md-12 gmaps mt60">
                <div id="map"></div>
              </div>
              <!-- End of Google Map -->


            </div>
            <!-- ===== End of Job Sidebar ===== -->

          </div>
          <!-- End of Row -->


          <!-- Start of Row -->
          <div class="row mt80">
            <div class="col-md-12">
              <h2 class="capitalize pb40">related jobs</h2>

              <!-- Start of Owl Slider -->
              <div class="owl-carousel related-jobs">
                <?php
                foreach($view_all_jobs as $alljobs)
                {
                  ?>
                  <!-- Start of Slide item 1 -->
                  <div class="item">
                    <a href="job-page.html">
                      <h5><?php echo $alljobs['job_title']; ?></h5>
                    </a>
                    <a href="#" class="btn btn-green btn-small btn-effect mt15"><?php echo $alljobs['job_location']; ?></a>

                    <h5 class="pt40 pb10"><i class="fa fa-money"></i> Salary:</h5>
                    <h5><?php echo $alljobs['job_salary']; ?></h5>
                  </div>
                  <?php } ?>
                  <!-- End of Slide item 1 -->

                </div>
                <!-- End of Owl Slider -->
              </div>
            </div>
            <!-- End of Row -->

          </div>
        </section>
        <!-- ===== End of Main Wrapper Job Section ===== -->


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

        $(document).on("click",".saveJob",function(){
          var jobId = $(this).attr('id');
          var this_ref = this;
          var str="jobId="+jobId;

          $.ajax({
            type: "GET",
            data: str,
            url: 'controller/savejob.php',
            cache: false,
            success: function(response) {
              if(response == -1) {
                alert("Please Log In");
              }
              else {
                $(this_ref).html(response).wrapInner('<span class="btn btn-success">Remove</span>');
                $(this_ref).removeClass("saveJob").addClass("removeJob");
                $(this_ref).$('#applied').load('viewjob.php #applied');
              }
            }
          });

        });
        $(document).on("click",".removeJob",function(){
          var jobId = $(this).attr('id');
          var this_ref = this;
          var str="jobId="+jobId;

          $.ajax({
            type: "GET",
            data: str,
            url: 'controller/removejob.php',
            cache: false,
            success: function(response) {
              if(response == -1) {
                alert("Please Log In");
              }
              else {
                $(this_ref).html(response).wrapInner('<i class="fa fa-star"></i>add to favorites');
                $(this_ref).removeClass("removeJob").addClass("saveJob");
                $(this_ref).$('#applied').load('viewjob.php #applied');
              }
            }
          });

        });
        </script>
