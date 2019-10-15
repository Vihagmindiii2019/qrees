
<style type="text/css">
.detail{
padding-left: 18px;
}
</style>
<?php 
if(!empty($info->profileImage && (empty($info->is_profile_url)))){ 
        $file = CDN_USER_MEDIUM_IMG.$info->profileImage;
        $fileName = CDN_USER_MEDIUM_IMG.$info->profileImage;
      }elseif(!empty($info->is_profile_url)){
        $fileName = $info->profileImage;
      }else{
        $fileName = USER_DEFAULT_AVATAR;
      }
?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>

    User Profile
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">User profile</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary"> 
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="<?php echo $fileName; ?>" alt="User profile picture">

            <h3 class="profile-username text-center"><?php echo ucfirst($info->userName); ?></h3>
            <center>
            <p style="margin-right: 18px;" class="text-muted detail"><?php echo $info->email; ?></p>
            </center>
          <!-- <p class="text-muted text-center">Software Engineer</p> -->

          </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">About Me</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">

            <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>

            <p class="text-muted detail"><?php echo $info->email; ?></p>

            <hr>
            <strong><i class="fa fa-phone margin-r-5"></i> Contact Number</strong>

            <p class="text-muted detail">+91-6260149658</p>

            <hr>
            <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>

            <p class="text-muted detail">Indore, Madhya Pradesh, India</p>

            <hr>
            <!-- <strong><i class="fa fa-map-marker margin-r-5"></i> Home Address</strong>

            <p class="text-muted detail">Indore, Madhya Pradesh, India</p>

            <hr> -->

          </div>
        <!-- /.box-body -->
        </div>
      <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
          <!-- <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
          <li><a href="#timeline" data-toggle="tab">Timeline</a></li> -->
            <li class="active"><a href="#settings" data-toggle="tab">My Posts</a></li>
          <!-- <li><a href="#changePassword" data-toggle="tab">Change Password</a></li> -->
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="settings">


              <div class="row">
                <span class="add-btn" style="display:  block;text-align: right;">
                </span>

                        <!-- /.box-header -->
                <div class="box-body ">
                           

                </div>
              <!-- /.tab-pane -->
              </div>
            <!-- /.tab-content -->
            </div>
          <!-- /.nav-tabs-custom -->
          </div>
        <!-- /.col -->
        </div>
      </div>
    </div>
  <!-- /.row -->

  </section>
<!-- /.content -->
</div>