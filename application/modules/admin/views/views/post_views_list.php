<div class="content-wrapper">
    <!-- Main content -->
  <section class="content">
      <section class="content-header">
        <h1>
        Post Comments(<span id="total"></span>)
        </h1>
        <!-- -->
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><a href="#">Post-Comments List</a></li>
        </ol> 
      </section>
      <div class="row">
        <div class="col-xs-12">
            <!-- <span class="add-btn" style="display:  block;text-align: right;">
              <button type="button" id="add_category_popup" onclick="add_sub_category_modal('admin')" class="btn btn-success btn-flat"><i class="fa fa-plus" aria-hidden="true"></i> ADD SUB CATEGORY</button>
            </span> -->
          <div class="box">
            <div class="box-body ">
            <!-- <p>sahci</p> -->

            <?php  $csrf = get_csrf_token()['hash'];?>

            <table id="comment_table" class="table" data-keys="<?php echo get_csrf_token()['name'];?>" data-values="<?php echo $csrf;?>">
              <thead>
                <th>S.No.</th>
                <th>Post Title</th> 
                <th>User</th> 
                <th>Email</th>  
                <th>Comment Message</th> 
                <th style="width: 12%">Action</th>
              </thead>
              <tbody>

              </tbody>
              <tfoot>

              </tfoot>
            </table>
            </div>
          </div>
        <!-- /.box-body -->
        </div>
      </div>

  </section>
    <!-- /.content -->
</div>
