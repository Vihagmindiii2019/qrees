
<style type="text/css">
.detail{
padding-left: 18px;
}
</style>
<?php 
if(!empty($userInfo->profileImage && (empty($userInfo->is_profile_url)))){ 
        $file = CDN_ADMIN_MEDIUM_IMG.$userInfo->profileImage;
        $fileName = CDN_ADMIN_MEDIUM_IMG.$userInfo->profileImage;
      }elseif(!empty($userInfo->is_profile_url)){
        $fileName = $userInfo->profileImage;
      }else{
        $fileName = base_url().USER_DEFAULT_AVATAR;
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

            <h3 class="profile-username text-center"><?php echo ucfirst($userInfo->userName); ?></h3>
            <center>
            <p style="margin-right: 18px;" class="text-muted detail"><?php echo $userInfo->email; ?></p>
            </center>
          <!-- <p class="text-muted text-center">Software Engineer</p> -->

          </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">About Post</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">

            <img class="profile-user-img img-responsive img-circle" src="<?php echo $fileName; ?>" alt="User profile picture">

            <h3 class="profile-username text-center"><?php echo ucfirst($postInfo->title); ?></h3>

            <hr>
            <strong><i class="fa fa-envelope margin-r-5"></i> Description</strong>

            <p class="text-muted detail"><?php echo $postInfo->description; ?></p>

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
          <!-- <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li> -->
            <li class="active"><a href="#settings" data-toggle="tab">Comments</a></li>
            <li><a href="#likes" data-toggle="tab">Likes</a></li> 
            <li><a href="#usersView" data-toggle="tab">Users View</a></li>
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
            <div class="tab-pane" id="likes">


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
            <div class="tab-pane" id="usersView">


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