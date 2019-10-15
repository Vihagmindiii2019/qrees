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

    var category_table = $("#category_table");
    var table_post = $('#category_table').DataTable({ 
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
      "url": base_url + "admin/category/category_list_ajax",
      // "url": base_url + "admin/users_list_ajax",
      "type": "POST",
      "dataType": "json",
      data:function(d) {
        var csrf_key = category_table.attr('data-keys');
        var csrf_hash = category_table.attr('data-values');
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
        category_table.attr('data-values',jsonData.csrf);
        return jsonData.data;
        }
      }
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { orderable: false, targets: -1 },

      ]

    });
});//category table end

//collection types table
$(function(){

    var collection_table = $("#collection_table");
    var table_post = $('#collection_table').DataTable({ 
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
      "url": base_url + "admin/collection_types/collection_types_list_ajax",
      // "url": base_url + "admin/users_list_ajax",
      "type": "POST",
      "dataType": "json",
      data:function(d) {
        var csrf_key = collection_table.attr('data-keys');
        var csrf_hash = collection_table.attr('data-values');
        d[csrf_key] = csrf_hash;
      },
      beforeSend: function(){
        show_loader()
      },
      dataSrc: function (jsonData) {
        hide_loader();
        $("#total").text(jsonData.recordsTotal);
        // $("#iframeloading").hide();
        if(jsonData.status==-1){
          location.reload();
        }else{
        collection_table.attr('data-values',jsonData.csrf);
        return jsonData.data;
        }
      }
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { orderable: false, targets: -1 },

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

    var sub_category_table = $("#sub_category_table");
    var table_post = $('#sub_category_table').DataTable({ 
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
      "url": base_url + "admin/sub_category/sub_category_list_ajax",
      // "url": base_url + "admin/users_list_ajax",
      "type": "POST",
      "dataType": "json",
      data:function(d) {
        var csrf_key = sub_category_table.attr('data-keys');
        var csrf_hash = sub_category_table.attr('data-values');
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
        sub_category_table.attr('data-values',jsonData.csrf);
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
    var product_table = $("#product_table");
    var table_post = $('#product_table').DataTable({ 
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
      "url": base_url + "admin/product/product_list_ajax",
      // "url": base_url + "admin/users_list_ajax",
      "type": "POST",
      "dataType": "json",
      data:function(d) {
        var csrf_key = product_table.attr('data-keys');
        var csrf_hash = product_table.attr('data-values');
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
        product_table.attr('data-values',jsonData.csrf);
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
    var offer_item_table = $("#offer_item_table");
    var table_post = $('#offer_item_table').DataTable({ 
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
      "url": base_url + "admin/weekly_offer/product_weekly_list_ajax",
      // "url": base_url + "admin/users_list_ajax",
      "type": "POST",
      "dataType": "json",
      data:function(d) {
        var csrf_key = offer_item_table.attr('data-keys');
        var csrf_hash = offer_item_table.attr('data-values');
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
        offer_item_table.attr('data-values',jsonData.csrf);
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


//add category modal start
var add_category_modal = function (controller) {

  var userType=$('.userTypeGet').data('user-type');
  $.ajax({
      url: base_url + controller + "/category/add_category_modal",
      // 
      type: 'GET',
      data:{'userType':userType},

      success: function (data, textStatus, jqXHR) {
          $('#add_category').html(data);
          $("#Modal").modal('show');

      }
  });
} //END OF ADD CATEGORY MODAL

//add collection modal start
var add_collection_popup = function (controller) {

  var userType=$('.userTypeGet').data('user-type');
  $.ajax({
      url: base_url + controller + "/collection_types/add_collection_modal",
      // 
      type: 'GET',
      data:{'userType':userType},

      success: function (data, textStatus, jqXHR) {
        console.log('success');
          $('#add_collction').html(data);
          $("#collectionModal").modal('show');

      }
  });
} //END OF ADD COLLECION MODAL

//add product modal start
var add_product_modal = function (controller) {

  var userType=$('.userTypeGet').data('user-type');
  $.ajax({
      url: base_url + controller + "/product/add_product_modal",
      // 
      type: 'GET',
      data:{'userType':userType},

      success: function (data, textStatus, jqXHR) {
          $('#add_product').html(data);
          $("#addProductModal").modal('show');

      }
  });
} //END OF ADD PRODUCT MODAL

//add category modal start
var add_sub_category_modal = function (controller) {

  var userType=$('.userTypeGet').data('user-type');
  $.ajax({
      url: base_url + controller + "/sub_category/add_sub_category_modal",
      // 
      type: 'GET',
      data:{'userType':userType},

      success: function (data, textStatus, jqXHR) {
          $('#add_sub_category').html(data);
          $("#Modal").modal('show');

      }
  });
} //END OF ADD SUB CATEGORY MODAL

//edit category modal start
var editCategory = function (controller,categoryId) {

  var userType=$('.userTypeGet').data('user-type');
  $.ajax({
      url: base_url + controller,
      // 
      type: 'GET',
      data:{'categoryId':categoryId},

      success: function (data, textStatus, jqXHR) {
          $('#edit_category').html(data);
          $("#editModal").modal('show');

      }
  });
} //END OF EDIT CATEGORY MODAL

//edit collection modal start
var editCollection = function (controller,collceionId) {

  var userType=$('.userTypeGet').data('user-type');
  $.ajax({
      url: base_url + controller,
      // 
      type: 'GET',
      data:{'collectionTypeId':collceionId},

      success: function (data, textStatus, jqXHR) {
          $('#edit_collection').html(data);
          $("#editCollectionModal").modal('show');

      }
  });
} //END OF EDIT CATEGORY MODAL


//edit sub category modal start
var editSubCategory = function (controller,categoryId) {

  var userType=$('.userTypeGet').data('user-type');
  $.ajax({
      url: base_url + controller,
      // 
      type: 'GET',
      data:{'categoryId':categoryId},

      success: function (data, textStatus, jqXHR) {
          $('#edit_sub_category').html(data);
          $("#editSubModal").modal('show');

      }
  });
} //END OF EDIT SUB CATEGORY MODAL

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

//starts of Category status change function
var deleteCategory= function(ctr,id){
  bootbox.confirm({
    message: "Are you sure you want to delete this ?",
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
        $.ajax({
          url:base_url + ctr ,
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
    }
  });
}

//starts of Category status change function
var statuChangeCategory= function(ctr,id){
    $.ajax({
      url:base_url + ctr ,
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
    var deleteProduct = function (controller,productId) {
        
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
    var deleteOfferItem = function (controller,productId) {
        
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


// variant values table
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
} //END OF EDIT VARIANT VALUES MODAL

//function for adding product in offer this week
var addOfferWeek = function(controller,productId) {
    $.ajax({
        type: "POST",
        url: base_url+controller,
        dataType:'json',
        data: {productId:productId}, //only input
        // processData: false,
        // contentType: false,
      beforeSend: function (){
                show_loader()
                },
      success: function(data){ 
        hide_loader();
        console.log(data);
        if(data.status==1){
            toastr.remove();
            toastr.clear();
              toastr.success(data.message)
        }else{
            $('#csrfs').val(data.csrf);
            toastr.remove();
            toastr.clear();
            toastr.error(data.message);

        }
        }
    });  
}
//for image cropping
   


//google place api
    function initializeAdd() {

    var autocomplete = new google.maps.places.Autocomplete(document.getElementById("address"));

    // Set the data fields to return when the user selects a place.
    autocomplete.setFields(
    ['address_components', 'geometry', 'icon', 'name']);

    autocomplete.addListener('place_changed', function() {

    var place = autocomplete.getPlace();

    //console.log(place.formatted_address);
    var country = '', city = '', cityAlt = ''; state = '';

    if(place.address_components){

        for(var i = 0; i < place.address_components.length; i += 1) {

        var addressObj = place.address_components[i];

        for(var j = 0; j < addressObj.types.length; j += 1) {

            if (!country && addressObj.types[j] === 'country') {

                //console.log(addressObj.types[j]); // confirm that this is 'country'
                country = addressObj.long_name; // confirm that this is the country name
            }

            if (!state && addressObj.types[j] === 'administrative_area_level_1') {

                //console.log(addressObj.types[j]); // confirm that this is 'state'
                state = addressObj.long_name; // confirm that this is the state name
            }

            if (!city && addressObj.types[j] === 'administrative_area_level_2') {

                //console.log(addressObj.types[j]); // confirm that this is 'city'
                city = addressObj.long_name; // confirm that this is the city name
            } 
        }

        if (city && state && country) {
        break;
        }
        } 

        var lat = place.geometry.location.lat(),
        lng = place.geometry.location.lng(),
        addr = place.formatted_address;
        $("#usrsadd").val(addr);
        $("#latitude").val(lat);
        $("#longitude").val(lng);
        $('#eventCity').val(city);
        $('#state').val(state);
        $('#eventCountry').val(country);
    }
    });
}
    google.maps.event.addDomListener(window, 'load', initializeAdd); //initialise google autocomplete API on load
