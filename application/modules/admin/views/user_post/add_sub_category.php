<div id="Modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <form action="<?php echo base_url('admin/sub_category/add_sub_category') ?>" class="form-horizontal" method="" id="add_sub_category_form"   enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Add Sub-Category</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body add_sub">
                        <div class="row">
                            <div class="col-md-12 mb_20" >
                                <div class="form-group">
                                  <input type="hidden" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>" id="csrf">
                                        <input type="text" class="form-control" name="sub_category_name" id="sub_category_name" placeholder="Category name" />
                                </div>
                                <div class="space-22"></div>
                           </div>
                            <div class="col-md-12 mb_20" >
                            
                              <select class="form-control" name="category" id="category">
                                  <option value="">Category</option>
                                  <?php if(!empty($categoryData)){
                                    foreach ($categoryData as $key => $value) { ?>
                                  <option value="<?php echo $value->categoryId?>"><?php echo $value->category_name;?></option>
                                      <?php
                                    } }
                                    ?>
                              </select>
                             
                            <!-- <div class="space-22"></div> -->
                            </div>
                         <div class="col-md-12 mb_20" >
                                <div class="form-group">
                                        <input type="text" class="form-control" name="category_desc" id="category_desc" placeholder="Category Description" />
                                </div>
                                <div class="space-22"></div>
                           </div>
                   </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                    <button type="submit" id="add_sub_category_button" class="btn btn-default" >Add</button>
                </div>
            </form>
        </div> <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  //end of add category modal

  //validation script
function show_loader(){
    $('.preloader').show();
}

function hide_loader(){
    $('.preloader').hide();
}

    
        $("#add_sub_category_form").validate({
        ignore: [],
        rules:{
            sub_category_name:{
                required: true,
                maxlength: 100
            },
            category_desc:{
                required: true,
                maxlength: 200
            },
            category:{
                required: true
            }
        },

        errorPlacement: function(error, element) 
        {
            if (element.attr("name") == "add_sub_category_form") 
            {
            error.insertAfter("#add_sub_category_form");
            } else {
            error.insertAfter(element);
            }
        }

        });
//end of validation script

var addSubCat = $("#add_sub_category_form");
var proceed_err  = 'Please fill all the fields properly';

$('#add_sub_category_button').on('click',function(){
    event.preventDefault();
    var actionUrl=$('#add_sub_category_form').attr('action');

    toastr.remove();
         event.preventDefault();
            if(addSubCat.valid()===false){
                toastr.error(proceed_err);
                return false;
            }
    formData = new FormData(document.getElementById('add_sub_category_form')),
    $.ajax({
        type: "POST",
        url: actionUrl,
        dataType:'json',
        data: formData, //only input
        processData: false,
        contentType: false,
      // beforeSend: function (){
      //           show_loader()
      //           },
      success: function(data){ 
        // hide_loader();
        console.log(data);
        //var res = JSON.parse(data);
         console.log(data.url);
        if(data.status==1){
            toastr.remove();
            toastr.clear();
           setTimeout(function(){
                window.location=data.url},
                2000),
              toastr.success(data.message)
        }else{
            $('#csrfs').val(data.csrf);
            toastr.remove();
            toastr.clear();
            toastr.error(data.message);

        }
        }
    });
   
});//end of login function

</script>