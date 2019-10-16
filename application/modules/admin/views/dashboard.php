 <style type="text/css">
   .col-lg-3 .fa{
      position: relative;
    padding-top: 11px;
}
 </style>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $total_post;?></h3>

              <p>Users Posts</p>
            </div>
            <div class="icon">
              <i class="fa fa-list-alt"></i>
            </div>
            <a href="<?php echo base_url();?>admin/MediaPost" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $total_post_views;?></h3>

              <p>All Posts Views</p>
            </div>
            <div class="icon">
              <i class="fa fa-tasks margin-r-5"></i>
            </div>
            <a href="<?php echo base_url();?>admin/PostViews" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $total_users;?></h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo base_url();?>admin/user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $total_comments;?></h3>

              <p> Total Comments</p>
            </div>
            <div class="icon">
              <i class="fa fa-comments-o margin-r-5"></i>
            </div>
            <a href="<?php echo base_url();?>admin/Comments" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?php echo $total_likes;?></h3>

              <p>Total User Likes</p>
            </div>
            <div class="icon">
              <i class="fa fa-thumbs-o-up margin-r-5"></i>
            </div>
            <a href="<?php echo base_url();?>admin/Likes" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?php echo $total_post_share;?></h3>

              <p>Total Posts Share</p>
            </div>
            <div class="icon">
              <i class="fa fa-share margin-r-5"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
      </div>

    </section>
    <!-- /.content -->
  </div>