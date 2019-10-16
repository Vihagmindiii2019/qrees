<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Qrees | <?php echo $title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="<?php echo APP_ADMIN_ASSETS_IMG;?>logo1.png" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().APP_ADMIN_ASSETS_CSS;?>bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().APP_ADMIN_ASSETS_CSS;?>AdminLTE.min.css">
  <!-- Material Design -->
  <link rel="stylesheet" href="<?php echo base_url().APP_ADMIN_ASSETS_CSS;?>bootstrap-material-design.min.css">
  <link rel="stylesheet" href="<?php echo base_url().APP_ADMIN_ASSETS_CSS;?>ripples.min.css">
  <link rel="stylesheet" href="<?php echo base_url().APP_ADMIN_ASSETS_CSS;?>MaterialAdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url().APP_ADMIN_ASSETS_CUSTOM_CSS;?>admin.css">
  <link href="<?php echo base_url().APP_ADMIN_ASSETS_CSS;?>toastr.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url().APP_ADMIN_ASSETS_PLUGIN;?>datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url().APP_ADMIN_ASSETS_PLUGIN;?>timepicker/bootstrap-timepicker.css">
  <link rel="stylesheet" href="<?php echo base_url().APP_ADMIN_ASSETS_PLUGIN;?>timepicker/bootstrap-datepicker.min.css">
  <!-- MaterialAdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url().APP_ADMIN_ASSETS_CSS;?>skins/all-md-skins.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-black sidebar-mini">
<div class="preloader" style="display: none;">
    <div class="loadinner">
        <!-- <img src="<?php echo base_url().APP_ADMIN_ASSETS_IMG; ?>giphy.gif"> --> Qrees Admin
    </div>
</div>
<!-- Site wrapper -->
<div class="wrapper">
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">
  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Qrees</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><!-- <img src="<?php echo base_url().APP_ADMIN_ASSETS_IMG;?>logo1.png" id="logo-image"> --> Qrees Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Notifications: style can be found in dropdown.less -->
          <!-- Tasks: style can be found in dropdown.less --> 
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php if(!empty($_SESSION[ADMIN_USER_SESS_KEY]['profile_image'])){ ?>
                <img src="<?php echo CDN_ADMIN_IMG_PATH.$_SESSION[ADMIN_USER_SESS_KEY]['profile_image'];?>" class="user-image" alt="User Image">
                <?php }else{?>
                <img src="<?php echo base_url().USER_DEFAULT_AVATAR;;?>" class="user-image" alt="User Image">
              <?php }?>
              <span class="hidden-xs"><?php echo $_SESSION[ADMIN_USER_SESS_KEY]['fullName'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">

                <?php if(!empty($_SESSION[ADMIN_USER_SESS_KEY]['profile_image'])){ ?>
                <img src="<?php echo CDN_ADMIN_MEDIUM_IMG.$_SESSION[ADMIN_USER_SESS_KEY]['profile_image'];?>" class="img-circle" alt="User Image">
                <?php }else{?>
                <img src="<?php echo base_url().USER_DEFAULT_AVATAR;;?>" class="user-image" alt="img-circle">
              <?php }?>

                <p>
                 <?php echo $_SESSION[ADMIN_USER_SESS_KEY]['email'];?>
                </p>
                <p>
                 <?php echo $_SESSION[ADMIN_USER_SESS_KEY]['fullName'];?>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo site_url(); ?>admin/admin_profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url();?>admin/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu">
        
        <li class="treeview">
          <a href="<?php echo base_url();?>admin/dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url();?>admin/user">
            <i class="ion ion-person-add"></i> <span>Users</span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url();?>admin/MediaPost">
            <i class="fa fa-list-alt margin-r-5"></i> <span>Media Posts</span>
          </a>
        </li><li class="treeview">
          <a href="<?php echo base_url();?>admin/comments">
            <i class="fa fa-comments-o margin-r-5"></i> <span>Comments</span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url();?>admin/likes">
            <i class="fa fa-thumbs-o-up margin-r-5"></i> <span>Likes</span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url();?>admin/PostViews">
            <i class="fa fa-tasks margin-r-5" aria-hidden="true"></i> <span> Posts Views</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>