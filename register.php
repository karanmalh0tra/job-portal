<?php include "header.php";?>

<!--Search Location API key here.-->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSkE7G79EbUYf0YA7ikEnCPGwKiDTiMkU&libraries=places&callback=initMap"async defer></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>

<script>
$(document).ready(function(){
  jQuery.noConflict()(function(){
    $("#myform").validate({
      rules: {
        name: "required",
        gender: "required",
        email: {
          required: true,
          email: true
        },
        pass: {
          required: true,
          minlength: 6
        },
        confirmpass: {
          required: true,
          equalTo: "#pass"
        },
        mobile: {
          required: true,
          minlength: 10,
          maxlength: 10,
          digits: true
        }
      },
      messages: {
        name: "Enter your name",
        gender: "Please enter your gender",
        email: {
          required: "Please enter your email ID",
          email: "Please enter a valid email address"
        },
        pass: {
          required: "Please enter your password",
          minlength: "Enter a password of minimum length 6"
        },
        confirmpass: "Enter same password in both the fields",
        mobile: {
          required: "Please enter your mobile number",
          minlength: "Please Enter a 10 digit mobile number",
          maxlength: "Please Enter a 10 digit mobile number",
          digits: "Please only enter numbers"
        }
      }
    });
    $("#companyform").validate({
      rules: {
        companyname: "required",
        companyaddress: "required",
        companycountry: "required",
        companystate: "required",
        companycity: "required",
        companycontactperson: "required",
        companyemail: {
          required: true,
          email: true
        },
        companypass: {
          required: true,
          minlength: 6
        },
        confirmcompanypass: {
          required: true,
          equalTo: "#companypass"
        },
        companycontact: {
          required: true,
          minlength: 10,
          maxlength: 10,
          digits: true
        }
      },
      messages: {
        companyname: "Enter Company's name",
        companyemail: {
          required: "Please enter Company's Email ID",
          email: "Please enter a valid email address"
        },
        companypass: {
          required: "Please enter a password",
          minlength: "Enter a password of minimum length 6"
        },
        confirmcompanypass: "Enter same password in both the fields",
        companyaddress: "Enter Company's Address",
        companycountry: "Enter the country where the company is located",
        companystate: "Enter the state where the company is located",
        companycity: "Enter the city where the company is located",
        companycontact: {
          required: "Please enter your mobile number",
          minlength: "Please Enter a 10 digit mobile number",
          maxlength: "Please Enter a 10 digit mobile number",
          digits: "Please only enter numbers"
        },
        companycontactperson: "Enter contact person's name"
      }
    });
  });
});
</script>

<style>

#myform label.error, #myform input.submit {

  color:red;
}

#companyform label.error, #companyform input.submit {

  color:red;
}
</style>




<!-- =============== Start of Page Header 1 Section =============== -->
<section class="page-header">
  <div class="container">

    <!-- Start of Page Title -->
    <div class="row">
      <div class="col-md-12">
        <h2>register</h2>
      </div>
    </div>
    <!-- End of Page Title -->

    <!-- Start of Breadcrumb -->
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="#">home</a></li>
          <li class="active">pages</li>
        </ul>
      </div>
    </div>
    <!-- End of Breadcrumb -->

  </div>
</section>
<!-- =============== End of Page Header 1 Section =============== -->





<!-- ===== Start of Login - Register Section ===== -->
<section class="ptb80" id="register">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <!-- Start of Nav Tabs -->
        <ul class="nav nav-tabs" role="tablist">

          <!-- Personal Account Tab -->
          <li role="presentation" class="active">
            <a href="#personal" aria-controls="personal" role="tab" data-toggle="tab" aria-expanded="true">
              <h6>Personal Account</h6>
              <span>I'm looking for a job</span>
            </a>
          </li>

          <!-- Company Account Tab -->
          <li role="presentation" class="">
            <a href="#company" aria-controls="company" role="tab" data-toggle="tab" aria-expanded="false">
              <h6>Company Account</h6>
              <span>We are hiring</span>
            </a>
          </li>
        </ul>
        <!-- End of Nav Tabs -->



        <!-- Start of Tab Content -->
        <div class="tab-content ptb60">

          <!-- Start of Tabpanel for Personal Account -->
          <div role="tabpanel" class="tab-pane active" id="personal">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">

                <!-- Form -->
                <form class="" id="myform" name="myform" action="controller/register.php" method="post">

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your Full Name" required/>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your active Email ID" required/>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Minimum 6 characters" required/>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group mb30">
                    <label>Confirm Password</label>
                    <input type="password" id="confirmpass" name="confirmpass" class="form-control" placeholder="Confirm your password" required/>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group mb30">
                    <label>Gender</label>
                    <select class="form-control" name="gender" id="gender">
                      <<option value="">Select Gender</option>
                      <option value="F">Female</option>
                      <option value="M">Male</option>
                    </select>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group mb30">
                    <label>Mobile</label>
                    <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Enter your mobile number" required/>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" id="location" class="form-control" placeholder="Enter your Location">
                  </div>

                  <!-- Form Group -->
                  <div class="form-group text-center">
                    <input type="checkbox" id="agree">
                    <label for="agree">Agree with the <a href="#">Terms and Conditions</a></label>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group text-center nomargin">
                    <button type="submit" class="btn btn-blue btn-effect">create account</button>
                  </div>

                </form>

              </div>
            </div>
          </div>
          <!-- End of Tabpanel for Personal Account -->

          <!-- Start of Tabpanel for Company Account -->
          <div role="tabpanel" class="tab-pane" id="company">
            <form class="" id="companyform" name="companyform" action="controller/companyregister.php" method="post">
              <div class="row">

                <!-- Start of the First Column -->
                <div class="col-md-6">

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Company name</label>
                    <input type="text" id="companyname" name="companyname" class="form-control" placeholder="Enter Company's Name" required/>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" id="companyemail" name="companyemail" class="form-control" placeholder="Enter Company's Email ID" required/>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="companypass" name="companypass" placeholder="Minimum 6 characters" required/>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="confirmcompanypass" name="confirmcompanypass" placeholder="Confirm Password" required/>
                  </div>

                </div>
                <!-- End of the First Column -->

                <!-- Start of the Second Column -->
                <div class="col-md-6">

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" id="companyaddress" name="companyaddress" required></textarea>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Location</label>
                    <input type="text" id="companylocation" name="companylocation" class="form-control" placeholder="" required/>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" id="companycontact" name="companycontact" class="form-control" placeholder="" required/>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                    <label>Contact Person</label>
                    <input type="text" id="companycontactperson" name="companycontactperson" class="form-control" placeholder="" required/>
                  </div>

                </div>
                <!-- End of the Second Column -->
              </div>

              <div class="row mt20">
                <div class="col-md-12 text-center">

                  <!-- Form Group -->
                  <div class="form-group">
                    <input type="checkbox" id="agree2">
                    <label for="agree2">Agree with the <a href="#">Terms and Conditions</a></label>
                  </div>

                  <!-- Form Group -->
                  <div class="form-group nomargin">
                    <button type="submit" class="btn btn-blue btn-effect">create account</button>
                  </div>

                </div>
              </div>
            </form>
          </div>
          <!-- End of Tabpanel for Company Account -->

        </div>
        <!-- End of Tab Content -->

      </div>
    </div>
  </div>
</section>
<!-- ===== End of Login - Register Section ===== -->





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


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSkE7G79EbUYf0YA7ikEnCPGwKiDTiMkU&libraries=places&callback=initMap"async defer></script>

<!--jquery api-->

//Used for AutoComplete Location via Google API
<script>
function initMap() {
  var input = document.getElementById('location');
  var autocomplete = new google.maps.places.Autocomplete(input);
}

</script>

<?php include "footer.php";?>
