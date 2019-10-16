<?php

class Comments extends Common_Back_Controller {
  	public function __construct(){
      	parent::__construct();
		$this->admin_user_session_key = ADMIN_USER_SESS_KEY; //user session key
       	$this->check_admin_user_session();
		$this->load->model('comments_model');
  	}

  	function index(){
  		$data['title'] = 'User Post Comments List';
  		$this->load->admin_render('comment/comments_list',$data);

  	}//END OF CATEGORY LIST FUCTION

  	function post_comments_list_ajax(){
  		//$this->check_admin_ajax_auth();
	    $no = $_POST['start'];
	    $list = $this->comments_model->get_list();
	        $data = array();
	        foreach ($list as $commentData) {
	        $action ='';
	        $no++;
	        $row = array();
	        $row[] = display_placeholder_text($no); 
          	$row[] = display_placeholder_text($commentData->title);
	        $row[] = display_placeholder_text($commentData->userName); 
          	$row[] = display_placeholder_text($commentData->email);
          	$row[] = display_placeholder_text($commentData->commentMsg);
          //$row[] = display_placeholder_text($commentData->description);
         
          $delete = "deleteComment('admin/Comments/delete_comment',$commentData->commentId);";
          $action .= ' <a style="font-size:17px;" href="javascript:void(0)"onclick="'.$delete.'" class="on-default edit-row table_action danger">  <i  class="fa fa-trash text-danger" aria-hidden="true"></i></a>';

	        $row[] = $action;
	        $data[] = $row;

	        }

	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->comments_model->count_all(),
	            "recordsFiltered" => $this->comments_model->count_filtered(),
	            "data" => $data,
	            "csrf"=>get_csrf_token()['hash']
	        );
	        //output to json format
	        echo json_encode($output);
  	}//END OF CATEGORY LISTING FUNCTION

  	

	

}
?>