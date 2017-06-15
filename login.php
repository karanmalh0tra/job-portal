<?php
session_start();     //session starts here
include "header.php";
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>

<script>
$(document).ready(function(){
  jQuery.noConflict()(function(){
    $("#myform").validate({
      rules: {
        email: {
          required: true,
          email: true
        },
        pass: {
          required: true,
          minlength: 6
        }
      },
      messages: {
        email: {
          required: "Please enter your email ID",
          email: "Please enter a valid email address"
        },
        pass: {
          required: "Please enter your password",
          minlength: "Enter a password of minimum length 6"
        }
      }
    });
  });
});
</script>

<style>

#myform label.error, #myform input.submit {

  color:red;
}
</style>


<!-- =============== Start of Page Header 1 Section =============== -->
<section class="page-header">
  <div class="container">

    <!-- Start of Page Title -->
    <div class="row">
      <div class="col-md-12">
        <h2>login</h2>
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
<section class="ptb80" id="login">
  <div class="container">
    <div class="col-md-6 col-md-offset-3 col-xs-12">

      <!-- Start of Login Box -->
      <div class="login-box">

        <div class="login-title">
          <h4>login to Rejoinher</h4>
        </div>

        <!-- Start of Login Form -->
        <form name="myform" id="myform" method="post" action="controller/login.php">
          <!-- Form Group -->
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Your Email">
          </div>

          <!-- Form Group -->
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="pass" class="form-control" placeholder="Your Password">
          </div>

          <!-- Form Group -->
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">

                <input type="checkbox" id="remember-me2">
                <label for="remember-me2">Remember me?</label>

              </div>

              <div class="col-xs-6 text-right">
                <a href="lost-password.html">Forgot password?</a>
              </div>
            </div>
          </div>

          <!-- Form Group -->
          <div class="form-group text-center">
            <button class="btn btn-blue btn-effect">Login</button>
            <a href="register.php" class="btn btn-blue btn-effect">signup</a>
          </div>

        </form>
        <!-- End of Login Form -->
      </div>
      <!-- End of Login Box -->

    </div>
  </div>
</section>
<!-- ===== End of Login - Register Section ===== -->


<?php include "footer.php";?>
