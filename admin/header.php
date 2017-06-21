<!DOCTYPE html>

<html lang="en">

<head>

<title>REJOINHER</title>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/colorpicker.css" />
<link rel="stylesheet" href="css/datepicker.css" />
<link rel="stylesheet" href="css/uniform.css" />
<link rel="stylesheet" href="css/select2.css" />
<link rel="stylesheet" href="css/fullcalendar.css" />
<link rel="stylesheet" href="css/matrix-style.css" />
<link rel="stylesheet" href="css/matrix-media.css" />
<link rel="stylesheet" href="css/bootstrap-wysihtml5.css" />
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>


</head>

<body>

<!--Header-part-->

<div id="header">

  <h1><a href="#">Paper Clyp Admin</a></h1>

</div>

<!--close-Header-part-->



<!--top-Header-menu-->

<div id="user-nav" class="navbar navbar-inverse">

  <ul class="nav">

    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle">  <i class="icon icon-cog"></i> <span class="text">Settings</span><b class="caret"></b></a>

      <ul class="dropdown-menu">

        <li><a href="profile.php"><i class="icon-user"></i> My Profile</a></li>

        <li class="divider"></li>

        <li><a href="change-password.php"><i class="icon-eye"></i> Change Password</a></li>

        <li class="divider"></li>

        <li><a href="logout.php"><i class="icon-key"></i> Log Out</a></li>

      </ul>

    </li>
<!--
    <li class="dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Notification</span> <span class="label label-important">5</span> <b class="caret"></b></a>

      <ul class="dropdown-menu">

        <li><a class="sAdd" title="" href="#"><i class="icon-plus"></i> new message</a></li>

        <li class="divider"></li>

        <li><a class="sInbox" title="" href="#"><i class="icon-envelope"></i> inbox</a></li>

        <li class="divider"></li>

        <li><a class="sOutbox" title="" href="#"><i class="icon-arrow-up"></i> outbox</a></li>

        <li class="divider"></li>

        <li><a class="sTrash" title="" href="#"><i class="icon-trash"></i> trash</a></li>

      </ul>

    </li>
-->


    <li class=""><a title="" href="logout.php"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>

  </ul>

</div>



<!--start-top-serch-->

<div id="search" style="color:white;">

  <marquee><i class="icon icon-user"></i><span class="text"> Welcome User@gmail.com</span></marquee>

</div>

<!--close-top-serch-->



<!--sidebar-menu-->



<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-list"></i>Dashboard</a>
  <ul>
    <li><a href="dashboard.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
	<li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Category Management</span> <span class="label label-important">5</span></a>
      <ul>
						<li><a href="add-category.php">Add Category</a></li>

						<li><a href="manage-category.php">Manage Category</a></li>

						<li><a href="add-sub-category.php">Add Sub-Category</a></li>

						<li><a href="manage-sub-category.php">Manage Sub-Category</a></li>
      </ul>
    </li>
    <li><a href="manage-company.php"><i class="icon icon-signal"></i> <span>Company Management</span></a> </li>
    <li><a href="manage-user.php"><i class="icon icon-inbox"></i> <span>User Management</span></a> </li>
    <li><a href="manage-advertisement.php"><i class="icon icon-th"></i> <span>Advertisement Management</span></a></li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Admin Management</span> <span class="label label-important">3</span></a>

      <ul>

        <li><a href="add-admin.php">Add Admin</a></li>
        <li><a href="manage-admin.php">Manage Admin</a></li>

      </ul>

    </li>


    <li class="content"> <span>Disk Space Usage</span>
      <div class="progress progress-mini active progress-striped">
        <div style="width: 87%;" class="bar"></div>
      </div>
      <span class="percent">87%</span>
      <div class="stat">604.44 / 4000 MB</div>
    </li>
  </ul>
</div>
