<?php

if (!isset($_SESSION)) session_start();
 ?>


<!DOCTYPE html>
<!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
<script>
$(document).ready(function(){
  alert("Hi");
  jQuery.noConflict()(function(){
  $("#mypopupform").validate({
    rules: {
      signin-password: {
        required: true,
        minlength: 6
      },
      signin-email: {
        required: true,
        email: true
      }
    },
    messages: {
      signin-password: {
        required: "Please enter your password",
        minlength: "Enter a password of minimum length 6"
      },
        signin-email: {
          required: "Please enter your email ID",
          email: "Please enter a valid email address"
        }
    }
  });
});
});
</script>

    <style>

  #mypopupform label.error, #mypopupform input.submit {

    color:red;
  }
  </style>
-->
<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- Mobile viewport optimized -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">

    <!-- Meta Tags - Description for Search Engine purposes -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <!-- Website Title -->
    <title>Rejoinher.com - Job Portal</title>
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,400i,700,800|Varela+Round" rel="stylesheet">

    <!-- CSS links -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
    <script>
    $(document).ready(function(){
  jQuery.noConflict()(function(){
      $("#mypopupform").validate({
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

  #mypopupform label.error, #mypopupform input.submit {

    color:red;
  }
  </style>
</head>

<body>

    <!-- =============== Start of Header 1 Navigation =============== -->
    <header class="header1">
        <nav class="navbar navbar-default navbar-static-top fluid_header centered">
            <div class="container">

                <!-- Logo -->
                <div class="col-md-2 col-sm-6 col-xs-8 nopadding">
                    <a class="navbar-brand nomargin" href="index.html"><img src="images/logo.png" alt="logo"></a>
                    <!-- INSERT YOUR LOGO HERE -->
                </div>

                <!-- ======== Start of Main Menu ======== -->
                <div class="col-md-10 col-sm-6 col-xs-4 nopadding">
                    <div class="navbar-header page-scroll">
                        <button type="button" class="navbar-toggle toggle-menu menu-right push-body" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Start of Main Nav -->
                    <div class="collapse navbar-collapse cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="main-nav">
                        <ul class="nav navbar-nav pull-right">

                            <!-- Mobile Menu Title -->
                            <li class="mobile-title">
                                <h4>main menu</h4></li>

                            <!-- Simple Menu Item -->
                            <li class="dropdown simple-menu active">
                                <a href="index.php" class="dropdown-toggle" data-toggle="dropdown" role="button">home</a>

                            </li>

                            <!-- Simple Menu Item -->
                            <li class="dropdown simple-menu">
                                <a href="viewjob.php" class="dropdown-toggle" data-toggle="dropdown" role="button">View Jobs</a>

                            </li>

                            <!-- Login Menu Item -->
                            <li class="menu-item login-btn">
                              <?php
                              if(!isset($_SESSION['user_email']) && empty($_SESSION['user_email']))
                              { ?>
                                <a id="modal_trigger" href="javascript:void(0)" role="button"><i class="fa fa-lock"></i>user login</a>
                              <?php } else { ?>
                                <a  href="logout.php" role="button">logout</a>
                              <?php } ?>

                                <!--<a id="modal_trigger" href="javascript:void(0)" role="button"><i class="fa fa-lock"></i>login</a>-->
                            </li>

                            <li class="menu-item login-btn">
                              <?php
                              if(!isset($_SESSION['company_email']) && empty($_SESSION['company_email']))
                              { ?>
                                <a id="modal_trigger" href="javascript:void(0)" role="button"><i class="fa fa-lock"></i>company login</a>
                              <?php } else { ?>
                                <a  href="logout.php" role="button">logout</a>
                              <?php } ?>

                                <!--<a id="modal_trigger" href="javascript:void(0)" role="button"><i class="fa fa-lock"></i>login</a>-->
                            </li>

                        </ul>
                    </div>
                    <!-- End of Main Nav -->
                </div>
                <!-- ======== End of Main Menu ======== -->

            </div>
        </nav>
    </header>
    <!-- =============== End of Header 1 Navigation =============== -->
