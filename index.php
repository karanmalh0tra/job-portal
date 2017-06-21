<?php include "header.php";?>

<?php

require_once "class/company-service.php";
$companyService = new CompanyService();
$view_all_jobs = $companyService->viewJob();
require_once "class/user-service.php";
$userService = new UserService();
$view_industry=$userService->viewIndustry();
$industry8 = $companyService->viewEightJobs();

?>


<!-- ===== Start of Main Search Section ===== -->
<section class="main overlay-black">

  <!-- Start of Wrapper -->
  <div class="container wrapper">
    <h1 class="capitalize text-center text-white">your career starts now</h1>

    <!-- Start of Form -->
    <form class="job-search-form row pt40" action="searchforjobs.php" method="get">

      <!-- Start of keywords input -->
      <div class="col-md-3 col-sm-12 search-keywords">
        <label for="search-keywords">Keywords</label>
        <input type="text" name="search-keywords" id="search-keywords" placeholder="Keywords">
      </div>

      <!-- Start of category input -->
      <div class="col-md-3 col-sm-12 search-categories">
        <label for="search-categories">Industry</label>
        <select name="search-industries" class="selectpicker" id="search-industries" data-live-search="true" title="Any Industry" data-size="5" data-container="body">
          <option value="" selected="selected">Select Industry</option>
          <?php
          foreach($view_industry as $industry)
          {
            ?>
            <option value="<?php echo $industry['industry_id']; ?>">
              <?php echo $industry['industry_name']; ?></option>
              <?php
            }
            ?>
        </select>
      </div>
      <!-- //TODO: Implement autosearch here -->
      <!-- Start of location input -->
      <div class="col-md-4 col-sm-12 search-location">
        <label for="search-location">Location</label>
        <input class='auto' type="text" name="search-location" id="tag" placeholder="Location">
      </div>

      <!-- Start of submit input -->
      <div class="col-md-2 col-sm-12 search-submit">
        <button type="submit" class="btn btn-blue btn-effect btn-large"><i class="fa fa-search"></i>search</button>
      </div>

    </form>
    <!-- End of Form -->

  </div>
  <!-- End of Wrapper -->

</section>
<!-- ===== End of Main Search Section ===== -->





<!-- ===== Start of Popular Categories Section ===== -->
<section class="ptb80" id="categories">
  <div class="container">

    <div class="section-title">
      <h2>popular industries</h2>
    </div>

    <div class="row nomargin">
      <?php foreach($industry8 as $i8)
      {

        $ind=$userService->viewIndustryById($i8['industry_id']); ?>

      <!-- Start of Category div -->
      <div class="col-md-3 col-sm-6 col-xs-12 cat-wrapper">
        <div class="category ptb30">

          <!-- Icon -->
          <div class="category-icon">
            <i class="fa fa-line-chart"></i>
          </div>

          <!-- Category Info - Title -->
          <div class="category-info pt30">
            <a href="#"><?php echo $ind['industry_name']; ?></a>
            <p></p>
          </div>

          <!-- Category Description -->
          <div class="category-descr">
            <span><?php echo $i8['occurances']; ?> Jobs Available</span>
          </div>

        </div>
      </div>
      <!-- End of Category div -->
      <?php }?>


      <div class="col-md-12 mt60 text-center">
        <a href="search-jobs-1.html" class="btn btn-blue btn-effect nomargin">browse all</a>
      </div>

    </div>
  </section>
  <!-- ===== End of Popular Categories Section ===== -->





  <!-- ===== Start of Signup & Video Section ===== -->
  <section id="signup-video">
    <div class="container-fluid">
      <div class="row">

        <!-- Start of Signup Column -->
        <div class="col-md-6 signup-sec ptb80 text-center">

          <div class="col-md-8 col-md-offset-2">

            <!-- Section Title -->
            <div class="section-title">
              <h2 class="text-white">Start your Career today by signing up now!</h2>
            </div>

            <p class="text-white mt20">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <a href="register.php" class="btn btn-purple btn-effect mt80">signup now!</a>

            <!-- Arrow Icon -->
            <img src="images/icons/arrow.svg" alt="" class="signup-arrow visible-lg-block">
          </div>

          <!-- Signup icon -->
          <img src="images/icons/icon1.svg" alt="" class="signup-icon visible-lg-block">
        </div>
        <!-- End of Signup Column -->


        <!-- Start of Video Column -->
        <div class="col-md-6 video-sec overlay-gradient">
          <a href="http://vimeo.com/99876106" class="popup-video"><i class="fa fa-play"></i></a>
        </div>
        <!-- End of Video Column -->

      </div>
    </div>
  </section>
  <!-- ===== End of Signup & Video Section ===== -->





  <!-- ===== Start of Job Post Section ===== -->
  <section class="ptb80" id="job-post">
    <div class="container">

      <!-- Start of Job Post Main -->
      <div class="col-md-8 col-sm-12 col-xs-12 job-post-main">
        <h2 class="capitalize"><i class="fa fa-briefcase"></i>latest jobs</h2>

        <!-- Start of Job Post Wrapper -->
        <div class="job-post-wrapper mt60">

          <!-- Start of Single Job Post 1 -->
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
                <a href="job-page.html">php senior developer</a>
              </div>

              <div class="job-info">
                <span class="company"><i class="fa fa-building-o"></i>envato</span>
                <span class="location"><i class="fa fa-map-marker"></i>Melbourn, Australia</span>
              </div>
            </div>

            <!-- Job Category -->
            <div class="col-md-2 col-xs-3 ptb30">
              <div class="job-category">
                <a href="javascript:void(0)" class="btn btn-green btn-small btn-effect">full time</a>
              </div>
            </div>
          </div>
          <!-- End of Single Job Post 1 -->

          <!-- Start of Single Job Post 2 -->
          <div class="single-job-post row nomargin">
            <!-- Job Company -->
            <div class="col-md-2 col-xs-3 nopadding">
              <div class="job-company">
                <a href="company-page-1.html">
                  <img src="images/companies/google.svg" alt="">
                </a>
              </div>
            </div>

            <!-- Job Title & Info -->
            <div class="col-md-8 col-xs-6 ptb20">
              <div class="job-title">
                <a href="job-page.html">department head</a>
              </div>

              <div class="job-info">
                <span class="company"><i class="fa fa-building-o"></i>google</span>
                <span class="location"><i class="fa fa-map-marker"></i>berlin, germany</span>
              </div>
            </div>

            <!-- Job Category -->
            <div class="col-md-2 col-xs-3 ptb30">
              <div class="job-category">
                <a href="javascript:void(0)" class="btn btn-purple btn-small btn-effect">part time</a>
              </div>
            </div>
          </div>
          <!-- End of Single Job Post 2 -->

          <!-- Start of Single Job Post 3 -->
          <div class="single-job-post row nomargin">
            <!-- Job Company -->
            <div class="col-md-2 col-xs-3 nopadding">
              <div class="job-company">
                <a href="company-page-1.html">
                  <img src="images/companies/facebook.svg" alt="">
                </a>
              </div>
            </div>

            <!-- Job Title & Info -->
            <div class="col-md-8 col-xs-6 ptb20">
              <div class="job-title">
                <a href="job-page.html">graphic designer</a>
              </div>

              <div class="job-info">
                <span class="company"><i class="fa fa-building-o"></i>facebook</span>
                <span class="location"><i class="fa fa-map-marker"></i>london, UK</span>
              </div>
            </div>

            <!-- Job Category -->
            <div class="col-md-2 col-xs-3 ptb30">
              <div class="job-category">
                <a href="javascript:void(0)" class="btn btn-blue btn-small btn-effect">freelancer</a>
              </div>
            </div>
          </div>
          <!-- End of Single Job Post 3 -->

          <!-- Start of Single Job Post 4 -->
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
                <a href="job-page.html">senior UI & UX designer</a>
              </div>

              <div class="job-info">
                <span class="company"><i class="fa fa-building-o"></i>envato</span>
                <span class="location"><i class="fa fa-map-marker"></i>Melbourn, Australia</span>
              </div>
            </div>

            <!-- Job Category -->
            <div class="col-md-2 col-xs-3 ptb30">
              <div class="job-category">
                <a href="javascript:void(0)" class="btn btn-orange btn-small btn-effect">intership</a>
              </div>
            </div>
          </div>
          <!-- End of Single Job Post 4 -->

          <!-- Start of Single Job Post 5 -->
          <div class="single-job-post row nomargin">
            <!-- Job Company -->
            <div class="col-md-2 col-xs-3 nopadding">
              <div class="job-company">
                <a href="company-page-1.html">
                  <img src="images/companies/twitter.svg" alt="">
                </a>
              </div>
            </div>

            <!-- Job Title & Info -->
            <div class="col-md-8 col-xs-6 ptb20">
              <div class="job-title">
                <a href="job-page.html">senior health advisor</a>
              </div>

              <div class="job-info">
                <span class="company"><i class="fa fa-building-o"></i>twitter</span>
                <span class="location"><i class="fa fa-map-marker"></i>New York, USA</span>
              </div>
            </div>

            <!-- Job Category -->
            <div class="col-md-2 col-xs-3 ptb30">
              <div class="job-category">
                <a href="javascript:void(0)" class="btn btn-red btn-small btn-effect">temporary</a>
              </div>
            </div>
          </div>
          <!-- End of Single Job Post 5 -->

        </div>
        <!-- End of Job Post Wrapper -->

        <!-- Start of Pagination -->
        <ul class="pagination list-inline text-center">
          <li class="active"><a href="javascript:void(0)">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">Next</a></li>
        </ul>
        <!-- End of Pagination -->

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

        <!-- Start of Upload Resume Widget -->
        <div class="upload-resume widget mt40 text-center">
          <h4 class="capitalize">upload your resume</h4>
          <p class="mtb10"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry...</p>

          <a href="submit-resume.html" class="btn btn-blue btn-effect mt10">upload resume</a>
        </div>
        <!-- End of Upload Resume Widget -->
      </div>
      <!-- End of Job Post Sidebar -->

    </div>
  </section>
  <!-- ===== End of Job Post Section ===== -->





  <!-- ===== Start of CountUp Section ===== -->
  <section class="ptb40" id="countup">
    <div class="container">

      <!-- 1st Count up item -->
      <div class="col-md-3 col-sm-3 col-xs-12">
        <span class="counter" data-from="0" data-to="743"></span>
        <h4>members</h4>
      </div>

      <!-- 2nd Count up item -->
      <div class="col-md-3 col-sm-3 col-xs-12">
        <span class="counter" data-from="0" data-to="579"></span>
        <h4>jobs</h4>
      </div>

      <!-- 3rd Count up item -->
      <div class="col-md-3 col-sm-3 col-xs-12">
        <span class="counter" data-from="0" data-to="251"></span>
        <h4>resumes</h4>
      </div>

      <!-- 4th Count up item -->
      <div class="col-md-3 col-sm-3 col-xs-12">
        <span class="counter" data-from="0" data-to="330"></span>
        <h4>companies</h4>
      </div>

    </div>
  </section>
  <!-- ===== End of CountUp Section ===== -->

  <!-- ===== Start of Latest News Section ===== -->
  <section class="ptb80" id="latest-news">
    <div class="container">

      <!-- Section Title -->
      <div class="section-title">
        <h2>latest news</h2>
      </div>

      <!-- Start of Blog Post -->
      <div class="col-md-4 col-xs-12">
        <div class="blog-post">
          <!-- Blog Post Image -->
          <div class="blog-post-thumbnail">
            <a href="blog-post.html" class="hover-link">
              <img src="images/blog/blog1.jpg" alt="">
            </a>
          </div>

          <!-- Blog Post Info -->
          <div class="post-info">
            <a href="blog-post.html">Top 10 tipps for Web Developers</a>

            <div class="post-details">
              <span class="date"><i class="fa fa-calendar"></i>September 7, 2016</span>
              <span class="comments"><i class="fa fa-comment"></i>0 Comments</span>
            </div>

            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy t ext ever since the 1500s....</p>

          </div>

          <!-- Read More Button -->
          <a href="blog-post.html" class="btn btn-blue btn-small btn-effect">read more</a>

        </div>
      </div>
      <!-- End of Blog Post -->

      <!-- Start of Blog Post -->
      <div class="col-md-4 col-xs-12">
        <div class="blog-post">
          <!-- Blog Post Image -->
          <div class="blog-post-thumbnail">
            <a href="blog-post.html" class="hover-link">
              <img src="images/blog/blog2.jpg" alt="">
            </a>
          </div>

          <!-- Blog Post Info -->
          <div class="post-info">
            <a href="blog-post.html">How to prepare for an Interview</a>

            <div class="post-details">
              <span class="date"><i class="fa fa-calendar"></i>September 7, 2016</span>
              <span class="comments"><i class="fa fa-comment"></i>0 Comments</span>
            </div>

            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy t ext ever since the 1500s....</p>

          </div>

          <!-- Read More Button -->
          <a href="blog-post.html" class="btn btn-blue btn-small btn-effect">read more</a>

        </div>
      </div>
      <!-- End of Blog Post -->

      <!-- Start of Blog Post -->
      <div class="col-md-4 col-xs-12">
        <div class="blog-post">
          <!-- Blog Post Image -->
          <div class="blog-post-thumbnail">
            <a href="blog-post.html" class="hover-link">
              <img src="images/blog/blog3.jpg" alt="">
            </a>
          </div>

          <!-- Blog Post Info -->
          <div class="post-info">
            <a href="blog-post.html">Freelancing vs Employment</a>

            <div class="post-details">
              <span class="date"><i class="fa fa-calendar"></i>September 7, 2016</span>
              <span class="comments"><i class="fa fa-comment"></i>0 Comments</span>
            </div>

            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy t ext ever since the 1500s....</p>

          </div>

          <!-- Read More Button -->
          <a href="blog-post.html" class="btn btn-blue btn-small btn-effect">read more</a>

        </div>
      </div>
      <!-- End of Blog Post -->

      <div class="col-md-12 col-xs-12 mt60 text-center">
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

        <a href="blog-right-sidebar-v1.html" class="btn btn-purple btn-effect mt20">visit blog</a>
      </div>

    </div>
  </section>
  <!-- ===== End of Latest News Section ===== -->

  <?php include "footer.php";?>
