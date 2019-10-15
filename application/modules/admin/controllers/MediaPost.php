<?php

class MediaPost extends Common_Back_Controller {
  	public function __construct(){
      	parent::__construct();
		$this->admin_user_session_key = ADMIN_USER_SESS_KEY; //user session key
       	$this->check_admin_user_session();
		$this->load->model('media_post_model');
  	}

  	function index(){
  		$data['title'] = 'User Posts List';
  		$this->load->admin_render('user_post/user_posts_list',$data);

  	}//END OF CATEGORY LIST FUCTION

  	function user_posts_list_ajax(){
  		//$this->check_admin_ajax_auth();
	    $no = $_POST['start'];
	    $list = $this->media_post_model->get_list();
	        $data = array();
	        foreach ($list as $postData) {
	        $action ='';
	        $no++;
	        $row = array();
	        $row[] = display_placeholder_text($no); 
	        $row[] = display_placeholder_text($postData->userName); 
          $row[] = display_placeholder_text($postData->email);
          $row[] = display_placeholder_text($postData->title);
          $row[] = display_placeholder_text($postData->mediaType);
          $row[] = display_placeholder_text($postData->description);
         
	        $clk_edit =  "editSubCategory('admin/sub_category/edit_sub_category_modal','$postData->postId');" ;
          $delete = "deleteCategory('admin/category/delete_category',$postData->postId);";
          $action = '<a style="font-size:17px;" href="javascript:void(0)" onclick="'.$clk_edit.'" class="on-default edit-row table_action" ><i style="font-size:17px;" class="fa fa-pencil-square-o text-success" aria-hidden="true"></i></a> ';
          $action .=  ' <a style="font-size:17px;" href="javascript:void(0)"onclick="'.$delete.'" class="on-default edit-row table_action danger"><i  class="fa fa-trash text-danger" aria-hidden="true"></i></a>';

	        $row[] = $action;
	        $data[] = $row;

	        }

	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->media_post_model->count_all(),
	            "recordsFiltered" => $this->media_post_model->count_filtered(),
	            "data" => $data,
	            "csrf"=>get_csrf_token()['hash']
	        );
	        //output to json format
	        echo json_encode($output);
  	}//END OF CATEGORY LISTING FUNCTION

  	function add_sub_category_modal(){
		$data['title'] = 'Add Category';
		$data['postData'] = $this->media_post_model->getcategory(CATEGORY,array('parent_category_id'=>0));
		//$this->check_admin_ajax_auth();
		$this->load->view('sub_category/add_sub_category', $data);
	} //END OF ADD CATEGORY MODAL

	

}
?>