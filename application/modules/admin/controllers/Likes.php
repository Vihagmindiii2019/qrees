<?php

class Likes extends Common_Back_Controller {
  	public function __construct(){
      	parent::__construct();
		$this->admin_user_session_key = ADMIN_USER_SESS_KEY; //user session key
       	$this->check_admin_user_session();
		$this->load->model('likes_model');
  	}

  	function index(){
  		$data['title'] = 'User Posts List';
  		$this->load->admin_render('likes/likes_list',$data);

  	}//END OF CATEGORY LIST FUCTION

  	function post_likes_list_ajax(){
  		//$this->check_admin_ajax_auth();
	    $no = $_POST['start'];
	    $list = $this->likes_model->get_list();
	        $data = array();
	        foreach ($list as $likeData) {
	        $action ='';
	        $no++;
	        $row = array();
	        $row[] = display_placeholder_text($no); 
          	$row[] = display_placeholder_text($likeData->title);
	        $row[] = display_placeholder_text($likeData->userName); 
          	$row[] = display_placeholder_text($likeData->email);
          	$row[] = display_placeholder_text($likeData->description);
         
	        $clk_edit =  "editSubCategory('admin/sub_category/edit_sub_category_modal','$likeData->likeId');" ;
          $delete = "deleteCategory('admin/category/delete_category',$likeData->likeId);";
          $action = '<a style="font-size:17px;" href="javascript:void(0)" onclick="'.$clk_edit.'" class="on-default edit-row table_action" ><i style="font-size:17px;" class="fa fa-pencil-square-o text-success" aria-hidden="true"></i></a> ';
          $action .=  ' <a style="font-size:17px;" href="javascript:void(0)"onclick="'.$delete.'" class="on-default edit-row table_action danger"><i  class="fa fa-trash text-danger" aria-hidden="true"></i></a>';

	        $row[] = $action;
	        $data[] = $row;

	        }

	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->likes_model->count_all(),
	            "recordsFiltered" => $this->likes_model->count_filtered(),
	            "data" => $data,
	            "csrf"=>get_csrf_token()['hash']
	        );
	        //output to json format
	        echo json_encode($output);
  	}//END OF CATEGORY LISTING FUNCTION


	

}
?>