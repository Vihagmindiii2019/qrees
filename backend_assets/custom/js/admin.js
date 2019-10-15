var base_url = $('#base_url').val();

function show_loader(){
    $('.preloader').show();
}

function hide_loader(){
    $('.preloader').hide();
}

$('#loginButton').on('click',function(){
    event.preventDefault();
    var actionUrl=$('#login_form').attr('action');
    formData = new FormData(document.getElementById('login_form')),
    $.ajax({
        type: "POST",
        url: actionUrl,
        dataType:'json',
        data: formData, //only input
        processData: false,
        contentType: false,
      beforeSend: function (){
                show_loader()
                },
      success: function(data){ 
        hide_loader();
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




$(function(){

    var user_post_table = $("#user_post_table");
    var table_post = $('#user_post_table').DataTable({ 
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' servermside processing mode.
      "order": [], //Initial no order.

      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,    
      "blengthChange": false,
      "iDisplayLength" :10,

      "bPaginate": true,
      "bInfo": true,
      "bFilter": false,
      "language": {                
      "infoFiltered": ""
      },

      // Load data for the table's content from an Ajax source
      "ajax": {
      "url": base_url + "admin/MediaPost/user_posts_list_ajax",
      // "url": base_url + "admin/users_list_ajax",
      "type": "POST",
      "dataType": "json",
      data:function(d) {
        var csrf_key = user_post_table.attr('data-keys');
        var csrf_hash = user_post_table.attr('data-values');
        d[csrf_key] = csrf_hash;
      },
      beforeSend: function(){
        show_loader()
      },
      dataSrc: function (jsonData) {
        hide_loader();
        // $("#iframeloading").hide();
        $('#total').html(jsonData.recordsFiltered);
        if(jsonData.status==-1){
          location.reload();
        }else{
        user_post_table.attr('data-values',jsonData.csrf);
        return jsonData.data;
        }
      }
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { orderable: false, targets: -1 },
      { orderable: false, targets: -2 },

      ]

    });
});//category table end


//user table 
$(function(){

    var user_table = $("#user_table");
    var table_post = $('#user_table').DataTable({ 
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' servermside processing mode.
      "order": [], //Initial no order.

      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,    
      "blengthChange": false,
      "iDisplayLength" :10,

      "bPaginate": true,
      "bInfo": true,
      "bFilter": false,
      "language": {                
      "infoFiltered": ""
      },

      // Load data for the table's content from an Ajax source
      "ajax": {
      "url": base_url + "admin/user/user_list_ajax",
      // "url": base_url + "admin/users_list_ajax",
      "type": "POST",
      "dataType": "json",
      data:function(d) {
        var csrf_key = user_table.attr('data-keys');
        var csrf_hash = user_table.attr('data-values');
        d[csrf_key] = csrf_hash;
      },
      beforeSend: function(){
        show_loader()
      },
      dataSrc: function (jsonData) {
        hide_loader();
        // $("#iframeloading").hide();
        $('#total').html(jsonData.recordsFiltered);
        if(jsonData.status==-1){
          location.reload();
        }else{
        user_table.attr('data-values',jsonData.csrf);
        return jsonData.data;
        }
      }
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { orderable: false, targets: -1 },

      ]

    });
});//user table end

//add sub category table
$(function(){

    var comment_table = $("#comment_table");
    var table_post = $('#comment_table').DataTable({ 
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' servermside processing mode.
      "order": [], //Initial no order.

      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,    
      "blengthChange": false,
      "iDisplayLength" :10,

      "bPaginate": true,
      "bInfo": true,
      "bFilter": false,
      "language": {                
      "infoFiltered": ""
      },

      // Load data for the table's content from an Ajax source
      "ajax": {
      "url": base_url + "admin/comments/post_comments_list_ajax",
      // "url": base_url + "admin/users_list_ajax",
      "type": "POST",
      "dataType": "json",
      data:function(d) {
        var csrf_key = comment_table.attr('data-keys');
        var csrf_hash = comment_table.attr('data-values');
        d[csrf_key] = csrf_hash;
      },
      beforeSend: function(){
        show_loader()
      },
      dataSrc: function (jsonData) {
        hide_loader();
        // $("#iframeloading").hide();
        $('#total').html(jsonData.recordsFiltered);
        if(jsonData.status==-1){
          location.reload();
        }else{
        comment_table.attr('data-values',jsonData.csrf);
        return jsonData.data;
        }
      }
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { orderable: false, targets: -1 },

      ]

    });
});//sub category table end


//add product table
$(function(){
    var likes_table = $("#likes_table");
    var table_post = $('#likes_table').DataTable({ 
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' servermside processing mode.
      "order": [], //Initial no order.

      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,    
      "blengthChange": false,
      "iDisplayLength" :10,

      "bPaginate": true,
      "bInfo": true,
      "bFilter": false,
      "language": {                
      "infoFiltered": ""
      },

      // Load data for the table's content from an Ajax source
      "ajax": {
      "url": base_url + "admin/Likes/post_likes_list_ajax",
      // "url": base_url + "admin/users_list_ajax",
      "type": "POST",
      "dataType": "json",
      data:function(d) {
        var csrf_key = likes_table.attr('data-keys');
        var csrf_hash = likes_table.attr('data-values');
        d[csrf_key] = csrf_hash;
      },
      beforeSend: function(){
        show_loader()
      },
      dataSrc: function (jsonData) {
        hide_loader();
        // $("#iframeloading").hide();
        $('#total').html(jsonData.recordsFiltered);
        if(jsonData.status==-1){
          location.reload();
        }else{
        likes_table.attr('data-values',jsonData.csrf);
        return jsonData.data;
        }
      }
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { orderable: false, targets: -1 },

      ]

    });
});//product table end

//offer Item list 
$(function(){
    var post_view_table = $("#post_view_table");
    var table_post = $('#post_view_table').DataTable({ 
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' servermside processing mode.
      "order": [], //Initial no order.

      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,    
      "blengthChange": false,
      "iDisplayLength" :10,

      "bPaginate": true,
      "bInfo": true,
      "bFilter": false,
      "language": {                
      "infoFiltered": ""
      },

      // Load data for the table's content from an Ajax source
      "ajax": {
      "url": base_url + "admin/PostViews/post_view_list_ajax",
      // "url": base_url + "admin/users_list_ajax",
      "type": "POST",
      "dataType": "json",
      data:function(d) {
        var csrf_key = post_view_table.attr('data-keys');
        var csrf_hash = post_view_table.attr('data-values');
        d[csrf_key] = csrf_hash;
      },
      beforeSend: function(){
        show_loader()
      },
      dataSrc: function (jsonData) {
        hide_loader();
        $("#total").text(jsonData.recordsFiltered);
        // $("#iframeloading").hide();
        if(jsonData.status==-1){
          location.reload();
        }else{
        post_view_table.attr('data-values',jsonData.csrf);
        return jsonData.data;
        }
      }
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { orderable: false, targets: -1 },

      ]

    });
});//product table end


//starts of user status change function
var statuChangeUser = function(ctr,id){
    $.ajax({
      url:base_url + ctr + "/statuChangeUser",
      type: 'GET',
      data:{'id':id},
      success: function(data){ 
        var res = JSON.parse(data);
        if(res.status==1){

        setTimeout(function(){
        window.location=res.url},
        2000),
        toastr.success(res.message)


        }else{
          toastr.error(res.message);

        }
      }

    });
}



//preview of image
jQuery('body').on('click', '.remove_img1', function () {
         var img = jQuery(this).data('avtar');
         jQuery('.ceo_logo img').attr('src', img);
         jQuery(this).css("display", "none");
         jQuery('#check_delete').val('1');
    });
  jQuery('body').on('change', '.input_img2', function () {

        var file_name = jQuery(this).val(),
            fileObj = this.files[0],
            calculatedSize = fileObj.size / (1024 * 1024),
            split_extension = file_name.substr( (file_name.lastIndexOf('.') +1) ).toLowerCase(), //this assumes that string will end with ext
            ext = ["jpg", "png", "jpeg"];
            console.log(split_extension+'---'+file_name.split("."));
        // if (jQuery.inArray(split_extension, ext) == -1){
        //     $(this).val(fileObj.value = null);
        //     $('.ceo_file_error').html('Invalid file format. Allowed formats: jpg, jpeg, png');
        //     return false;
        // }
        
        if (calculatedSize > 5){
            $(this).val(fileObj.value = null);
            $('.ceo_file_error').html('File size should not be greater than 5MB');
            return false;
        }
        if (jQuery.inArray(split_extension, ext) != -1 && calculatedSize < 10){
            $('.ceo_file_error').html('');
            readURL(this);
        }

        $('.edit_img').addClass("imUpload");
    });

  function readURL(input) {
        var cur = input;
        if (cur.files && cur.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(cur).hide();
                $(cur).next('span:first').hide();
                $(cur).next().next('img').attr('src', e.target.result);
                $(cur).next().next('img').css("display", "block");
                $(cur).next().next().next('span').attr('style', "");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    jQuery('body').on('click', '.remove_img', function () {
        var img = jQuery(this).prev()[0];
        var span = jQuery(this).prev().prev()[0];
        var input = jQuery(this).prev().prev().prev()[0];
        jQuery(img).attr('src', '').css("display", "none");
        jQuery(span).css("display", "block");
        jQuery(input).css("display", "inline-block");
        jQuery(this).css("display", "none");
        jQuery(".image_hide").css("display", "block");
        jQuery("#file").val("");

        $('.edit_img').removeClass("imUpload");
    });

    //start delete product
    var deleteUserPost = function (controller,productId) {
        
        bootbox.confirm({
            message: "Are you sure you want to change status ?",
            buttons: {
                confirm: {
                    label: 'OK',
                    className: 'btn btn-primary'
                },
                cancel: {
                    label: 'Cancel',
                    className: 'btn-default'
                }
            },
            callback: function (result) {
                if (result){
                    var url = base_url+controller;
                    $.ajax({
                        method: "GET",
                        url: url,
                        dataType: "json",
                        data: {productId: productId},
                        beforeSend: function () {
                            show_loader()
                            },

                        success: function (data){
                            hide_loader();
                            if(data.status==1){
                                 setTimeout(function(){
                                location.reload();},2000
                                )
                                toastr.success(data.message)
                            }else{
                                toastr.error(data.error);
                            }
                        },
                        
                       
                    });
                }
            }
        });

    }


    //start offer item product
    var deletePostComment = function (controller,productId) {
        
        bootbox.confirm({
            message: "Are you sure you want to delete this product from weekly offer list ?",
            buttons: {
                confirm: {
                    label: 'OK',
                    className: 'btn btn-primary'
                },
                cancel: {
                    label: 'Cancel',
                    className: 'btn-default'
                }
            },
            callback: function (result) {
                if (result){
                    var url = base_url+controller;
                    $.ajax({
                        method: "GET",
                        url: url,
                        dataType: "json",
                        data: {productId: productId},
                        beforeSend: function () {
                            show_loader()
                            },

                        success: function (data){
                            hide_loader();
                            if(data.status==1){
                                 setTimeout(function(){
                                location.reload();},2000
                                )
                                toastr.success(data.message)
                            }else{
                                toastr.error(data.error);
                            }
                        },
                        
                       
                    });
                }
            }
        });

    }

  //admin profile update
  $("#editProfile").validate({
    ignore: [],
    rules:{
      full_name:{
          required: true,
          maxlength: 100
      },
    },

    errorPlacement: function(error, element) 
    {
      if (element.attr("name") == "editProfile") 
      {
      error.insertAfter("#editProfile");
      } else {
      error.insertAfter(element);
      }
    }
  });
  //end of validation script
  var edit_profile = $("#editProfile");
  var proceed_err  = 'Please fill all the fields properly';

  $(document).on('click', "#profileSubmit", function (event) {
    event.preventDefault();
    toastr.remove();
    event.preventDefault();
    if(edit_profile.valid()===false){
        toastr.error(proceed_err);
        return false;
    }
    var formData = new FormData($("#editProfile")[0]);
    $.ajax({
      url : $("#editProfile").attr('action'),
      type : "post",
      data : formData, //only input
      contentType : false,
      processData : false,
      beforeSend : function(){
        show_loader();
      },
      success : function(response, textStatus, jqXHR){
        hide_loader();
        try {                        
          var data = $.parseJSON(response);
          if (data.status == 1)
          {
            toastr.success(data.message);
                    
            window.setTimeout(function () {
              window.location.href = data.url;
            }, 2000);
                      
          }else {
            toastr.error(data.message);
                   
            setTimeout(function () {
              $('#error-box').hide(800);
            }, 1000);
          }
        } 
        catch (e) {
          toastr.error(data.message);
          setTimeout(function () {
            $('#error-box').hide(800);
          }, 1000);
        }
      }
    });
  });

  //admin change password
  $("#editPassword").validate({
    ignore: [],
    rules:{
      password:{
          required: true,
      },
      npassword:{
          required: true,
      },
      rnpassword:{
          required: true,
          equalTo : "#npassword"
      },
    },

    messages: {
      password: {
        required: "Please enter your current password",
      },
      npassword: {
        required: "Please enter your new password",
      },
      rnpassword: {
        required: "Please retype your new password",
        equalTo: "Please enter the same password as above"
      }
    },

    errorPlacement: function(error, element) 
    {
      if (element.attr("name") == "editPassword") 
      {
      error.insertAfter("#editPassword");
      } else {
      error.insertAfter(element);
      }
    }
  });

  var editpwd = $("#editPassword");
  var proceed_err  = 'Please fill all the fields properly';
  $(document).on('click', "#passwordsubmit", function (event) {
    toastr.remove();
    event.preventDefault();
    if(editpwd.valid()===false){
        toastr.error(proceed_err);
        return false;
    }
    var formData = new FormData($("#editPassword")[0]);
    $.ajax({
      type: "POST",
      url: $("#editPassword").attr('action'),
      data: formData, //only input
      processData: false,
      contentType: false,
        beforeSend: function () {
        show_loader();
      },
      success: function (response, textStatus, jqXHR) {
        hide_loader();
        try {
                    
          var data = $.parseJSON(response);
          if (data.status == 1)
          {
            toastr.success(data.message);
                    
            window.setTimeout(function () {
              window.location.href = data.url;
            }, 2000);
                      
          }
          else {
            toastr.error(data.message);                  
            setTimeout(function () {
              $('#error-box').hide(800);
            }, 1000);
          }
        } 
        catch (e) {
          toastr.error(data.message);
          setTimeout(function () {
              $('#error-box').hide(800);
          }, 1000);
        }
      }
    });
  });


/*// variant values table
$(function(){
  var variant_table = $('#variant_values_table');
  var table_post = $('#variant_values_table').DataTable({ 
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' servermside processing mode.
    "order": [], //Initial no order.

    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,    
    "blengthChange": false,
    "iDisplayLength" :10,

    "bPaginate": true,
    "bInfo": true,
    "bFilter": false,
    "language": {                
    "infoFiltered": ""
    },

    // Load data for the table's content from an Ajax source
    "ajax": {
    "url": base_url + "admin/variant/sub_variant_list_ajax",
    "type": "POST",
    "dataType": "json",
    data:function(d) {
      var csrf_key = variant_table.attr('data-keys');
      var csrf_hash = variant_table.attr('data-values');
      d[csrf_key] = csrf_hash;
    },
    beforeSend: function(){
      show_loader()
    },
    dataSrc: function (jsonData) {
      hide_loader();
      $("#total").text(jsonData.recordsFiltered);
      if(jsonData.status==-1){
        location.reload();
      }else{
      variant_table.attr('data-values',jsonData.csrf);
      return jsonData.data;
      }
    }
    },
    //Set column definition initialisation properties.
    "columnDefs": [
    { orderable: false, targets: -1 },

    ]

  });
});//variant values table end

//add variant values modal start
var add_variant_values_modal = function (controller) {

  var userType=$('.userTypeGet').data('user-type');
  $.ajax({
      url: base_url + controller + "/variant/add_variant_values_modal",
      // 
      type: 'GET',
      data:{'userType':userType},

      success: function (data, textStatus, jqXHR) {
          $('#add_variant_values').html(data);
          $("#Modal").modal('show');

      }
  });
} //END OF ADD VARIANT VALUES MODAL

//edit sub variant values start
var editVariantValues = function (controller,variantValueId) {

  var userType=$('.userTypeGet').data('user-type');
  $.ajax({
      url: base_url + controller,
      // 
      type: 'GET',
      data:{'variantValueId':variantValueId},

      success: function (data, textStatus, jqXHR) {
          $('#edit_variant_values').html(data);
          $("#editSubModal").modal('show');

      }
  });
} //END OF EDIT VARIANT VALUES MODAL*/


    
